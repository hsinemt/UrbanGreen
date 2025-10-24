<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\ImageGenerationService;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\CommentSummaryService;

class EventController extends Controller
{
    /**
     * Generate AI summary of event comments.
     */
    public function getSummary(Event $event, CommentSummaryService $summaryService)
    {
        try {
            $summary = $summaryService->getSummary($event);

            return response()->json([
                'success' => true,
                'data' => $summary
            ], 200, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $events = $query->with('project')->latest()->get();
        return view('frontOffice.pages.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = \App\Models\Activity::all();
        $projects = \App\Models\Projet::all();
        return view('frontOffice.pages.events.create', compact('activities', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        set_time_limit(120); // Extend time for AI image generation

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date|after:today',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'project_id' => 'nullable|exists:projets,id',
            'activities' => 'nullable|array',
            'activities.*' => 'exists:activities,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        try {
            // Handle manual upload
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('events', 'public');
            } else {
                // Generate AI image if no manual upload
                $imageService = new ImageGenerationService();
                $generatedImage = $imageService->generateEventImage(
                    $validated['name'],
                    $validated['description'] ?? null,
                    $validated['location']
                );
                $validated['image'] = $generatedImage ?? null;
            }

            $event = Event::create($validated);

            // Attach activities
            if ($request->has('activities')) {
                $event->activities()->attach($request->activities);
            }

            return redirect()->route('events.index')->with('success', 'Event created successfully!');
        } catch (\Exception $e) {
            \Log::error('Event creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create event. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);

        // Fetch related resources
        $eventResources = $event->resources()->with('supplier')->latest()->get();

        // Weather data
        $weatherData = null;
        if ($event->location && $event->date) {
            $weatherService = new WeatherService();
            $weatherData = $weatherService->getWeatherForEvent($event->location, $event->date);
        }

        // Feedback statistics
        $averageRating = \App\Models\Feedback::getAverageRatingForEvent($event->id) ?? 0;
        $totalFeedbackCount = $event->feedback()->active()->count();

        // Load feedback and replies
        $topLevelFeedback = $event->feedback()
            ->topLevel()
            ->active()
            ->latest()
            ->with(['user', 'replies' => function ($query) {
                $query->with('user')->latest();
            }])
            ->paginate(10);

        return view('frontOffice.pages.events.show', compact(
            'event',
            'eventResources',
            'weatherData',
            'averageRating',
            'totalFeedbackCount',
            'topLevelFeedback'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $activities = \App\Models\Activity::all();
        $projects = \App\Models\Projet::all();
        return view('frontOffice.pages.events.edit', compact('event', 'activities', 'projects'));
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'regenerate_image' => 'nullable|boolean',
        ]);

        // Handle manual image upload
        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        } elseif ($request->has('regenerate_image')) {
            // Regenerate AI image
            $imageService = new ImageGenerationService();
            $generatedImage = $imageService->generateEventImage(
                $validated['name'],
                $validated['description'] ?? null,
                $validated['location']
            );
            $validated['image'] = $generatedImage ?? null;
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

    /**
     * Delete multiple events at once.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'event_ids' => 'required|array|min:1',
            'event_ids.*' => 'exists:events,id',
        ]);

        $events = Event::whereIn('id', $request->event_ids)->get();

        foreach ($events as $event) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $event->delete();
        }

        return redirect()->route('events.index')->with('success', count($events) . ' event(s) deleted successfully!');
    }

    /**
     * Search events via AJAX for live search.
     */
    public function search(Request $request)
    {
        $query = Event::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $events = $query->latest()->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontOffice.pages.events.partials.event-list', compact('events'))->render(),
                'count' => $events->count()
            ]);
        }

        return view('frontOffice.pages.events.index', compact('events'));
    }

    /**
     * Remove activity from event.
     */
    public function removeActivity(Request $request, string $id)
    {
        $event = Event::findOrFail($id);
        $activityId = $request->input('activity_id');
        $event->activities()->detach($activityId);

        return redirect()->route('events.show', $event->id)->with('success', 'Activity removed successfully!');
    }

    /**
     * Get AI-generated summary for event comments.
     */
//    public function getSummary(string $id)
//    {
//        try {
//            $event = Event::findOrFail($id);
//
//            $summaryService = new \App\Services\CommentSummaryService();
//            $summary = $summaryService->getSummary($event);
//
//            // Return with proper UTF-8 encoding flags to handle any special characters
//            return response()->json([
//                'success' => true,
//                'data' => $summary
//            ], 200, ['Content-Type' => 'application/json; charset=utf-8'],
//                JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE
//            );
//
//        } catch (\Exception $e) {
//            return response()->json([
//                'success' => false,
//                'error' => $e->getMessage()
//            ], 400, ['Content-Type' => 'application/json; charset=utf-8'],
//                JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE
//            );
//        }
//    }
}
