<?php

namespace App\Http\Controllers;

use App\Models\GreenSpace;
use Illuminate\Http\Request;

class GreenSpaceController extends Controller
{
    // Liste tous les espaces verts
    public function index()
    {
        return GreenSpace::all();
    }

    // Crée un nouvel espace vert
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'surface' => 'required|numeric',
            'availability' => 'boolean',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
        ]);
        return GreenSpace::create($validated);
    }

    // Affiche un espace vert spécifique
    public function show($id)
    {
        return GreenSpace::findOrFail($id);
    }

    // Met à jour un espace vert
    public function update(Request $request, $id)
    {
        $greenSpace = GreenSpace::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'location' => 'sometimes|required|string',
            'surface' => 'sometimes|required|numeric',
            'availability' => 'boolean',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
        ]);
        $greenSpace->update($validated);
        return $greenSpace;
    }

    // Supprime un espace vert
    public function destroy($id)
    {
        $greenSpace = GreenSpace::findOrFail($id);
        $greenSpace->delete();
        return response()->json(['message' => 'Supprimé avec succès']);
    }
}
