<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('location', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        $events = $query->latest()->get();
        return view('frontOffice.pages.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    // No need to fetch events for create form
    return view('frontOffice.pages.events.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date|after:today',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return view('frontOffice.pages.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('frontOffice.pages.events.edit', compact('event'));
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            
            $validated['image'] = $request->file('image')->store('events', 'public');
        } else {
            // Keep the existing image if no new image is uploaded
            unset($validated['image']);
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
        
        // Delete associated image if exists
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
        
        // Delete associated images
        foreach ($events as $event) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
        }

        // Delete the events
        Event::whereIn('id', $request->event_ids)->delete();

        $count = count($request->event_ids);
        return redirect()->route('events.index')->with('success', "{$count} event(s) deleted successfully!");
    }

    /**
     * Search events via AJAX for live search
     */
    public function search(Request $request)
    {
        $query = Event::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('location', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        $events = $query->latest()->get();
        
        // Return JSON response for AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontOffice.pages.events.partials.event-list', compact('events'))->render(),
                'count' => $events->count()
            ]);
        }
        
        return view('frontOffice.pages.events.index', compact('events'));
    }
}