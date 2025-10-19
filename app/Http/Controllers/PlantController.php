<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\GreenSpace;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Plant::with('greenSpace');
        
        // Filtrer par Green Space si spécifié
        if ($request->has('green_space_id') && $request->green_space_id) {
            $query->where('green_space_id', $request->green_space_id);
        }
        
        $plants = $query->paginate(10);
        $greenSpaces = GreenSpace::all();
        
        return view('dashboard.components.plants.index', compact('plants', 'greenSpaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $greenSpaces = GreenSpace::all();
        $selectedGreenSpaceId = $request->get('green_space_id');
        return view('dashboard.components.plants.create', compact('greenSpaces', 'selectedGreenSpaceId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date_plantation' => 'required|date',
            'date_croissance_prevue' => 'required|date|after:date_plantation',
            'personne_plantation' => 'required|string|max:255',
            'milieu_croissance' => 'required|string|max:255',
            'green_space_id' => 'required|exists:green_spaces,id',
        ]);

        Plant::create($validated);

        return redirect()->route('admin.plants.index')
            ->with('success', 'Plante ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant): View
    {
        $plant->load('greenSpace');
        return view('dashboard.components.plants.show', compact('plant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant): View
    {
        $greenSpaces = GreenSpace::all();
        return view('dashboard.components.plants.edit', compact('plant', 'greenSpaces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date_plantation' => 'required|date',
            'date_croissance_prevue' => 'required|date|after:date_plantation',
            'personne_plantation' => 'required|string|max:255',
            'milieu_croissance' => 'required|string|max:255',
            'green_space_id' => 'required|exists:green_spaces,id',
        ]);

        $plant->update($validated);

        return redirect()->route('admin.plants.index')
            ->with('success', 'Plante mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant): RedirectResponse
    {
        $plant->delete();

        return redirect()->route('admin.plants.index')
            ->with('success', 'Plante supprimée avec succès.');
    }
}
