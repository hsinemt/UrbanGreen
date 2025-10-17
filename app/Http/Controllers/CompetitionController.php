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
            'partner_id' => Auth::id(),
            'projet_id' => $project->id,
            'reward' => $validated['reward'],
            'description' => $validated['description'] ?? null,
        ]);

        $competition->associations()->sync($validated['association_ids']);

        // Send email invites via Brevo HTTP API (batch)
        try {
            $assocs = User::whereIn('id', $validated['association_ids'])->get();
            $recipients = $assocs->map(fn($u) => ['email' => $u->email, 'name' => $u->name])->values()->all();
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
            'projet_id' => $project->id,
            'reward' => $validated['reward'],
            'description' => $validated['description'] ?? null,
        ]);
        $competition->associations()->sync($validated['association_ids']);
        return redirect()->route('competitions.index')->with('success', 'Competition updated successfully.');
    }

    public function destroy(Competition $competition)
    {
        if (!Auth::check() || !Auth::user()->isPartner() || $competition->partner_id !== Auth::id()) {
            abort(403);
        }
        $competition->delete();
        return redirect()->route('competitions.index')->with('success', 'Competition deleted successfully.');
    }
}


