<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GreenSpace;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GreenSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $greenSpaces = GreenSpace::withCount('plants')->paginate(10);

        return view('dashboard.components.green-spaces.index', compact('greenSpaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.components.green-spaces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'surface' => 'required|numeric|min:0',
            'availability' => 'boolean',
            'description' => 'nullable|string',
            'type' => 'nullable|string|max:255',
        ]);

        GreenSpace::create($validated);

        return redirect()->route('admin.green-spaces.index')
            ->with('success', 'Espace vert ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GreenSpace $greenSpace): View
    {
        $greenSpace->load('plants');

        return view('dashboard.components.green-spaces.show', compact('greenSpace'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GreenSpace $greenSpace): View
    {
        return view('dashboard.components.green-spaces.edit', compact('greenSpace'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GreenSpace $greenSpace): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'surface' => 'required|numeric|min:0',
            'availability' => 'boolean',
            'description' => 'nullable|string',
            'type' => 'nullable|string|max:255',
        ]);

        $greenSpace->update($validated);

        return redirect()->route('admin.green-spaces.index')
            ->with('success', 'Espace vert mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GreenSpace $greenSpace): RedirectResponse
    {
        $greenSpace->delete();

        return redirect()->route('admin.green-spaces.index')
            ->with('success', 'Espace vert supprimé avec succès.');
    }
}
