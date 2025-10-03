<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\ProjectStatusChange;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Projet::query()->latest();

        // Filters: search (name/description), status, start/end dates
        if ($search = request('q')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }
        if ($status = request('status')) {
            $query->where('status', $status);
        }
        if ($start = request('start_date')) {
            $query->whereDate('start_date', '>=', $start);
        }
        if ($end = request('end_date')) {
            $query->whereDate('end_date', '<=', $end)->orWhere(function($q) use ($end){
                // include ongoing projects with null end_date if end filter provided
                $q->whereNull('end_date')->whereDate('start_date', '<=', $end);
            });
        }

        $projects = $query->get();
        
        // Statistics
        $stats = [
            'total' => Projet::count(),
            'by_status' => Projet::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray(),
            'total_budget' => Projet::sum('budget'),
            'avg_progress' => Projet::avg('progress_percentage'),
            'completed_count' => Projet::where('status', 'completed')->count(),
            'in_progress_count' => Projet::where('status', 'in_progress')->count(),
        ];
        
        return view('frontOffice.pages.projects.show', compact('projects', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projet = new Projet();
        $statuses = Projet::allowedStatuses();
        return view('frontOffice.pages.projects.form', compact('projet', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        $projet = Projet::create($validated);
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        // Load relationships
        $projet->load(['risks', 'issues']);
        
        // Get related projects (same status)
        $relatedProjects = Projet::where('id', '!=', $projet->id)
            ->where('status', $projet->status)
            ->limit(3)
            ->get();

        return view('frontOffice.pages.projects.details', compact('projet', 'relatedProjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projet $projet)
    {
        $statuses = Projet::allowedStatuses();
        return view('frontOffice.pages.projects.form', compact('projet', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet)
    {
        $validated = $this->validateRequest($request);

        // Workflow guard: log status transitions
        if (isset($validated['status']) && $validated['status'] !== $projet->status) {
            if (!Projet::canTransition($projet->status, $validated['status'])) {
                return back()->withErrors(['status' => 'Invalid status transition'])->withInput();
            }
        }

        $oldStatus = $projet->status;
        $projet->update($validated);

        if ($oldStatus !== $projet->status) {
            ProjectStatusChange::create([
                'projet_id' => $projet->id,
                'from_status' => $oldStatus,
                'to_status' => $projet->status,
                'user_id' => auth()->id(),
            ]);
        }
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        $projet->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    /**
     * Validate incoming create/update request
     */
    protected function validateRequest(Request $request): array
    {
        $statusValues = implode(',', Projet::allowedStatuses());

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ["required", "in:$statusValues"],
            'slug' => ['nullable', 'string', 'max:255'],
            'priority' => ['nullable', 'integer', 'between:1,5'],
            'visibility' => ['nullable', 'in:public,private'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'progress_percentage' => ['required', 'integer', 'between:0,100'],
            'budget' => ['required', 'numeric', 'min:0'],
        ]);
    }
}
