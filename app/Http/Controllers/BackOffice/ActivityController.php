<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Activity::query();

        // Search functionality
        if ($request->has('search') && ! empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && ! empty($request->status)) {
            $query->where('status', $request->status);
        }

        $activities = $query->latest()->paginate(10);

        return view('dashboard.components.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.components.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'time_to_finish' => 'nullable|integer|min:1',
            'num_persons' => 'required|integer|min:1',
        ]);

        Activity::create($validated);

        return redirect()->route('back.activities.index')->with('success', 'Activity created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = Activity::with('events')->findOrFail($id);

        return view('dashboard.components.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activity = Activity::findOrFail($id);

        return view('dashboard.components.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $activity = Activity::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'time_to_finish' => 'nullable|integer|min:1',
            'num_persons' => 'required|integer|min:1',
        ]);

        $activity->update($validated);

        return redirect()->route('back.activities.index')->with('success', 'Activity updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('back.activities.index')->with('success', 'Activity deleted successfully!');
    }

    /**
     * Delete multiple activities at once.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'activity_ids' => 'required|array|min:1',
            'activity_ids.*' => 'exists:activities,id',
        ]);

        Activity::whereIn('id', $request->activity_ids)->delete();

        $count = count($request->activity_ids);

        return redirect()->route('back.activities.index')->with('success', "{$count} activity(ies) deleted successfully!");
    }
}
