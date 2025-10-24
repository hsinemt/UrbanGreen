<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Event;
use App\Services\ImageGenerationService;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Search functionality
        if ($request->has('search') && ! empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $events = $query->with('project')->latest()->paginate(10);

        return view('dashboard.components.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = Activity::all();
        $projects = \App\Models\Projet::all();

        return view('dashboard.components.events.create', compact('activities', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Increase execution time limit for AI image generation
        set_time_limit(120); // 2 minutes

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date|after:today',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'project_id' => 'nullable|exists:projets,id',
            'activities' => 'nullable|array',
            'activities.*' => 'exists:activities,id',
        ]);

        try {
            // Generate AI image using multiple fallback methods
            $imageService = new ImageGenerationService;
            $generatedImage = $imageService->generateEventImage(
                $validated['name'],
                $validated['description'] ?? null,
                $validated['location']
            );

            if ($generatedImage) {
                $validated['image'] = $generatedImage;
                \Log::info('Image generated successfully', ['image' => $generatedImage]);
            } else {
                \Log::warning('Image generation failed, creating event without image');
                $validated['image'] = null;
            }

            $event = Event::create($validated);

            // Attach activities if provided
            if ($request->has('activities')) {
                $event->activities()->attach($request->activities);
            }

            return redirect()->route('back.events.index')->with('success', 'Event created successfully!');

        } catch (\Exception $e) {
            \Log::error('Event creation failed: '.$e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create event. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::with('activities')->findOrFail($id);

        // Get weather data for the event
        $weatherData = null;
        if ($event->location && $event->date) {
            $weatherService = new WeatherService;
            $weatherData = $weatherService->getWeatherForEvent($event->location, $event->date);
        }

        return view('dashboard.components.events.show', compact('event', 'weatherData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::with('activities')->findOrFail($id);
        $activities = Activity::all();
        $projects = \App\Models\Projet::all();

        return view('dashboard.components.events.edit', compact('event', 'activities', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'project_id' => 'nullable|exists:projets,id',
            'activities' => 'nullable|array',
            'activities.*' => 'exists:activities,id',
            'regenerate_image' => 'nullable|boolean',
        ]);

        // Handle image regeneration
        if ($request->has('regenerate_image')) {
            // Delete old image if exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            // Generate new AI image
            $imageService = new ImageGenerationService;
            $generatedImage = $imageService->generateEventImage(
                $validated['name'],
                $validated['description'] ?? null,
                $validated['location']
            );

            if ($generatedImage) {
                $validated['image'] = $generatedImage;
            }
        }

        $event->update($validated);

        // Update activities relationship
        if ($request->has('activities')) {
            $event->activities()->sync($request->activities);
        } else {
            $event->activities()->detach();
        }

        return redirect()->route('back.events.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        // Delete associated image if exists
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('back.events.index')->with('success', 'Event deleted successfully!');
    }

    /**
     * Bulk delete events
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'event_ids' => 'required|array',
            'event_ids.*' => 'exists:events,id',
        ]);

        $events = Event::whereIn('id', $request->event_ids)->get();

        foreach ($events as $event) {
            // Delete associated image if exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $event->delete();
        }

        return redirect()->route('back.events.index')->with('success', count($events).' events deleted successfully!');
    }

    /**
     * Remove activity from event
     */
    public function removeActivity(Request $request, string $id)
    {
        $event = Event::findOrFail($id);
        $activityId = $request->input('activity_id');

        $event->activities()->detach($activityId);

        return redirect()->route('back.events.show', $event->id)->with('success', 'Activity removed from event successfully!');
    }
}
