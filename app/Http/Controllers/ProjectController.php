<?php

namespace App\Http\Controllers;

use App\Models\ProjectStatusChange;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Projet::query()->latest();

        // If the logged-in user is an association or partner, only show their projects
        if (\Illuminate\Support\Facades\Auth::check() && (\Illuminate\Support\Facades\Auth::user()->isAssociation() || \Illuminate\Support\Facades\Auth::user()->isPartner())) {
            $query->where('user_id', \Illuminate\Support\Facades\Auth::id());
        }

        // Filters: search (name/description), status, start/end dates
        if ($search = request('q')) {
            $query->where(function ($q) use ($search) {
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
            $query->whereDate('end_date', '<=', $end)->orWhere(function ($q) use ($end) {
                // include ongoing projects with null end_date if end filter provided
                $q->whereNull('end_date')->whereDate('start_date', '<=', $end);
            });
        }

        $projects = $query->with('user')->get();

        // Statistics
        $statsQuery = clone $query;
        $stats = [
            'total' => (clone $statsQuery)->count(),
            'by_status' => (clone $statsQuery)->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray(),
            'total_budget' => (clone $statsQuery)->sum('budget'),
            'avg_progress' => (clone $statsQuery)->avg('progress_percentage'),
            'completed_count' => (clone $statsQuery)->where('status', 'completed')->count(),
            'in_progress_count' => (clone $statsQuery)->where('status', 'in_progress')->count(),
        ];

        return view('frontOffice.pages.projects.show', compact('projects', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Auth::check() || ! (Auth::user()->isAssociation() || Auth::user()->isPartner())) {
            abort(403, 'Only associations can create projects.');
        }
        $projet = new Projet;
        $statuses = Projet::allowedStatuses();

        return view('frontOffice.pages.projects.form', compact('projet', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Auth::check() || ! (Auth::user()->isAssociation() || Auth::user()->isPartner())) {
            abort(403, 'Only associations can create projects.');
        }
        $validated = $this->validateRequest($request);
        $validated['user_id'] = Auth::id();
        $projet = Projet::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        //        // Load relationships
        //        $projet->load(['risks', 'issues']);

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
        if (! Auth::check() || ! (Auth::user()->isAssociation() || Auth::user()->isPartner())) {
            abort(403, 'Only associations can edit projects.');
        }
        $statuses = Projet::allowedStatuses();

        return view('frontOffice.pages.projects.form', compact('projet', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet)
    {
        if (! Auth::check() || ! (Auth::user()->isAssociation() || Auth::user()->isPartner())) {
            abort(403, 'Only associations can update projects.');
        }
        $validated = $this->validateRequest($request);

        // Workflow guard: log status transitions
        if (isset($validated['status']) && $validated['status'] !== $projet->status) {
            if (! Projet::canTransition($projet->status, $validated['status'])) {
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
        if (! Auth::check() || ! (Auth::user()->isAssociation() || Auth::user()->isPartner())) {
            abort(403, 'Only associations can delete projects.');
        }
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
            'status' => ['required', "in:$statusValues"],
            'user_id' => ['nullable', 'exists:users,id'],
            'slug' => ['nullable', 'string', 'max:255'],
            'priority' => ['nullable', 'integer', 'between:1,5'],
            'visibility' => ['nullable', 'in:public,private'],
            'tags' => ['nullable', 'string'],
            'tags.*' => ['string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'progress_percentage' => ['required', 'integer', 'between:0,100'],
            'budget' => ['required', 'numeric', 'min:0'],
        ]);
    }

    // Dashboard/Back Office Methods
    public function dashboardIndex(Request $request)
    {
        $query = Projet::query()->with(['user']);

        // If the logged-in user is an association or partner, only show their projects
        if (Auth::check() && (Auth::user()->isAssociation() || Auth::user()->isPartner())) {
            $query->where('user_id', Auth::id());
        }

        // Filters: search, status, user, date range
        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($userId = $request->get('user_id')) {
            $query->where('user_id', $userId);
        }

        if ($start = $request->get('start_date')) {
            $query->whereDate('start_date', '>=', $start);
        }

        if ($end = $request->get('end_date')) {
            $query->whereDate('end_date', '<=', $end)->orWhere(function ($q) use ($end) {
                $q->whereNull('end_date')->whereDate('start_date', '<=', $end);
            });
        }

        $projects = $query->latest()->paginate(15);

        // Get filter options
        $users = User::whereIn('role', [User::ROLE_ASSOCIATION, User::ROLE_PARTNER])->get();
        $statuses = Projet::allowedStatuses();

        // Statistics - use the same filtered query
        $statsQuery = clone $query;
        $stats = [
            'total' => (clone $statsQuery)->count(),
            'by_status' => (clone $statsQuery)->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray(),
            'total_budget' => (clone $statsQuery)->sum('budget'),
            'avg_progress' => (clone $statsQuery)->avg('progress_percentage'),
            'completed_count' => (clone $statsQuery)->where('status', 'completed')->count(),
            'in_progress_count' => (clone $statsQuery)->where('status', 'in_progress')->count(),
        ];

        return view('dashboard.components.projects.index', compact('projects', 'users', 'statuses', 'stats'));
    }

    public function dashboardCreate()
    {
        $projet = new Projet;
        $statuses = Projet::allowedStatuses();
        $users = User::whereIn('role', [User::ROLE_ASSOCIATION, User::ROLE_PARTNER])->get();

        return view('dashboard.components.projects.create', compact('projet', 'statuses', 'users'));
    }

    public function dashboardStore(Request $request)
    {
        $validated = $this->validateRequest($request);
        $projet = Projet::create($validated);

        return redirect()->route('back.projects.index')->with('success', 'Project created successfully.');
    }

    public function dashboardShow(Projet $projet)
    {
        $projet->load(['user', 'statusChanges.user']);

        // Get related projects
        $relatedProjects = Projet::where('id', '!=', $projet->id)
            ->where('status', $projet->status)
            ->limit(5)
            ->get();

        return view('dashboard.components.projects.show', compact('projet', 'relatedProjects'));
    }

    public function dashboardEdit(Projet $projet)
    {
        $statuses = Projet::allowedStatuses();
        $users = User::whereIn('role', [User::ROLE_ASSOCIATION, User::ROLE_PARTNER])->get();

        return view('dashboard.components.projects.edit', compact('projet', 'statuses', 'users'));
    }

    public function dashboardUpdate(Request $request, Projet $projet)
    {
        $validated = $this->validateRequest($request);

        // Log status transitions
        if (isset($validated['status']) && $validated['status'] !== $projet->status) {
            if (! Projet::canTransition($projet->status, $validated['status'])) {
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

        return redirect()->route('back.projects.index')->with('success', 'Project updated successfully.');
    }

    public function dashboardDestroy(Projet $projet)
    {
        $projet->delete();

        return redirect()->route('back.projects.index')->with('success', 'Project deleted successfully.');
    }
}
