<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompetitionInviteMail;
use Illuminate\Support\Facades\Http;
use App\Models\Notification;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Competition::query()->with(['partner', 'project', 'associations']);

        // Filters: partner, project, search
        if ($partnerId = $request->get('partner_id')) {
            $query->where('partner_id', $partnerId);
        }
        if ($projectId = $request->get('projet_id')) {
            $query->where('projet_id', $projectId);
        }
        if ($search = $request->get('q')) {
            $query->where(function($q) use ($search) {
                $q->where('reward', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        $competitions = $query->latest()->paginate(10);
        return view('frontOffice.pages.competitions.index', compact('competitions'));
    }
    protected function createNotification($userIds, $data)
    {
        foreach ($userIds as $userId) {
            Notification::create([
                'type' => 'competition',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => $userId,
                'data' => $data,
                'read_at' => null,
            ]);
        }
    }
    public function create()
    {
        if (!Auth::check() || !Auth::user()->isPartner()) {
            abort(403);
        }
        // Only projects created by this partner
        $projects = Projet::where('user_id', Auth::id())->get();
        // Associations to pick from
        $associations = User::where('role', User::ROLE_ASSOCIATION)->get();
        return view('frontOffice.pages.competitions.form', [
            'competition' => new Competition(),
            'projects' => $projects,
            'associations' => $associations,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isPartner()) {
            abort(403);
        }
        $validated = $request->validate([
            'projet_id' => ['required', 'exists:projets,id'],
            'reward' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'association_ids' => ['required', 'array', 'min:1'],
            'association_ids.*' => ['exists:users,id'],
        ]);

        // Ensure the project belongs to the partner
        $project = Projet::where('id', $validated['projet_id'])->where('user_id', Auth::id())->firstOrFail();

        $competition = Competition::create([
            'name' => $validated['reward'], // Use reward as name for front office
            'partner_id' => Auth::id(),
            'projet_id' => $project->id,
            'reward' => $validated['reward'],
            'description' => $validated['description'] ?? null,
        ]);

        $competition->associations()->sync($validated['association_ids']);
        $this->createNotification(
            $validated['association_ids'],
            [
                'title' => 'Nouvelle compétition',
                'message' => 'Vous avez été ajouté à la compétition "' . $competition->name . '"',
                'competition_id' => $competition->id
            ]
        );
        // Send email invites via Brevo HTTP API (batch)
        try {
            $recipients = $associations->map(fn($u) => ['email' => $u->email, 'name' => $u->name])->values()->all();
            if (!empty($recipients)) {
                $subject = 'Competition Invitation';
                $projectName = optional($competition->project)->name;
                $html = "<p>you are now officially participating in the competition '" . e($projectName) . "' , we are happy to welcome you</p>";
                Http::withHeaders([
                    'api-key' => env('BREVO_API_KEY'),
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ])->post('https://api.brevo.com/v3/smtp/email', [
                    'sender' => ['email' => 'aziiz.hameed@gmail.com', 'name' => 'UrbanGreen'],
                    'to' => $recipients,
                    'subject' => $subject,
                    'htmlContent' => $html,
                ]);
            }
        } catch (\Throwable $e) {
            // Optionally log error
        }

        return redirect()->route('competitions.index')->with('success', 'Competition created successfully.');
    }

    public function show(Competition $competition)
    {
        $competition->load(['partner', 'project', 'associations']);
        return view('frontOffice.pages.competitions.show', compact('competition'));
    }

    public function edit(Competition $competition)
    {
        if (!Auth::check() || !Auth::user()->isPartner() || $competition->partner_id !== Auth::id()) {
            abort(403);
        }
        $projects = Projet::where('user_id', Auth::id())->get();
        $associations = User::where('role', User::ROLE_ASSOCIATION)->get();
        return view('frontOffice.pages.competitions.form', compact('competition', 'projects', 'associations'));
    }

    public function update(Request $request, Competition $competition)
    {
        if (!Auth::check() || !Auth::user()->isPartner() || $competition->partner_id !== Auth::id()) {
            abort(403);
        }
        $validated = $request->validate([
            'projet_id' => ['required', 'exists:projets,id'],
            'reward' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'association_ids' => ['required', 'array', 'min:1'],
            'association_ids.*' => ['exists:users,id'],
        ]);

        // Ensure the project belongs to the partner
        $project = Projet::where('id', $validated['projet_id'])->where('user_id', Auth::id())->firstOrFail();

        $competition->update([
            'name' => $validated['reward'], // Use reward as name for front office
            'projet_id' => $project->id,
            'reward' => $validated['reward'],
            'description' => $validated['description'] ?? null,
        ]);
        $competition->associations()->sync($validated['association_ids']);
        $this->createNotification(
            $validated['association_ids'],
            [
                'title' => 'Compétition mise à jour',
                'message' => 'La compétition "' . $competition->name . '" a été mise à jour',
                'competition_id' => $competition->id
            ]
        );
        return redirect()->route('competitions.index')->with('success', 'Competition updated successfully.');
    }

    public function destroy(Competition $competition)
    {
        if (!Auth::check() || !Auth::user()->isPartner() || $competition->partner_id !== Auth::id()) {
            abort(403);
        }
        $competition->delete();
        $this->createNotification(
            $competition->associations->pluck('id')->toArray(),
            [
                'title' => 'Compétition supprimée',
                'message' => 'La compétition "' . $competition->name . '" a été supprimée',
                'competition_id' => $competition->id
            ]
        );
        return redirect()->route('competitions.index')->with('success', 'Competition deleted successfully.');
    }

    // Dashboard/Back Office Methods
    public function dashboardIndex(Request $request)
    {
        $query = Competition::query()->with(['partner', 'project', 'associations']);

        // Filters: partner, project, search
        if ($partnerId = $request->get('partner_id')) {
            $query->where('partner_id', $partnerId);
        }
        
        if ($projectId = $request->get('projet_id')) {
            $query->where('projet_id', $projectId);
        }
        
        if ($search = $request->get('q')) {
            $query->where(function($q) use ($search) {
                $q->where('reward', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        $competitions = $query->latest()->paginate(15);
        
        // Get filter options
        $partners = User::where('role', User::ROLE_PARTNER)->get();
        $projects = Projet::all();
        
        // Statistics
        $stats = [
            'total' => Competition::count(),
            'by_partner' => Competition::with('partner')
                ->selectRaw('partner_id, COUNT(*) as count')
                ->groupBy('partner_id')
                ->get()
                ->pluck('count', 'partner.name')
                ->toArray(),
            'total_projects' => Competition::distinct('projet_id')->count(),
            'total_associations' => Competition::withCount('associations')->get()->sum('associations_count'),
        ];

        return view('dashboard.components.competitions.index', compact('competitions', 'partners', 'projects', 'stats'));
    }

    public function dashboardCreate()
    {
        $competition = new Competition();
        $projects = Projet::all();
        $partners = User::where('role', User::ROLE_PARTNER)->get();
        $associations = User::where('role', User::ROLE_ASSOCIATION)->get();
        
        return view('dashboard.components.competitions.create', compact('competition', 'projects', 'partners', 'associations'));
    }

    public function dashboardStore(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'partner_id' => ['required', 'exists:users,id'],
            'projet_id' => ['required', 'exists:projets,id'],
            'reward' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'association_ids' => ['required', 'array', 'min:1'],
            'association_ids.*' => ['exists:users,id'],
        ]);

        $competition = Competition::create([
            'name' => $validated['name'],
            'partner_id' => $validated['partner_id'],
            'projet_id' => $validated['projet_id'],
            'reward' => $validated['reward'],
            'description' => $validated['description'] ?? null,
        ]);

        $competition->associations()->sync($validated['association_ids']);

        // Send email invites via Brevo HTTP API (batch)
        try {
            $recipients = $associations->map(fn($u) => ['email' => $u->email, 'name' => $u->name])->values()->all();
            if (!empty($recipients)) {
                $subject = 'Competition Invitation';
                $projectName = optional($competition->project)->name;
                $html = "<p>you are now officially participating in the competition '" . e($projectName) . "' , we are happy to welcome you</p>";
                Http::withHeaders([
                    'api-key' => env('BREVO_API_KEY'),
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ])->post('https://api.brevo.com/v3/smtp/email', [
                    'sender' => ['email' => 'aziiz.hameed@gmail.com', 'name' => 'UrbanGreen'],
                    'to' => $recipients,
                    'subject' => $subject,
                    'htmlContent' => $html,
                ]);
            }
        } catch (\Throwable $e) {
            // Optionally log error
        }

        return redirect()->route('back.competitions.index')->with('success', 'Competition created successfully.');
    }

    public function dashboardShow(Competition $competition)
    {
        $competition->load(['partner', 'project', 'associations']);
        return view('dashboard.components.competitions.show', compact('competition'));
    }

    public function dashboardEdit(Competition $competition)
    {
        $projects = Projet::all();
        $partners = User::where('role', User::ROLE_PARTNER)->get();
        $associations = User::where('role', User::ROLE_ASSOCIATION)->get();
        
        return view('dashboard.components.competitions.edit', compact('competition', 'projects', 'partners', 'associations'));
    }

    public function dashboardUpdate(Request $request, Competition $competition)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'partner_id' => ['required', 'exists:users,id'],
            'projet_id' => ['required', 'exists:projets,id'],
            'reward' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'association_ids' => ['required', 'array', 'min:1'],
            'association_ids.*' => ['exists:users,id'],
        ]);

        $competition->update([
            'name' => $validated['name'],
            'partner_id' => $validated['partner_id'],
            'projet_id' => $validated['projet_id'],
            'reward' => $validated['reward'],
            'description' => $validated['description'] ?? null,
        ]);
        
        $competition->associations()->sync($validated['association_ids']);
        
        return redirect()->route('back.competitions.index')->with('success', 'Competition updated successfully.');
    }

    public function dashboardDestroy(Competition $competition)
    {
        $competition->delete();
        return redirect()->route('back.competitions.index')->with('success', 'Competition deleted successfully.');
    }
}


