<?php

namespace App\Http\Controllers;

use App\Models\GreenSpace;
use Illuminate\Http\Request;

class GreenSpaceController extends Controller
{

    public function index()
    {
        return GreenSpace::all();
    }

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

    public function show($id)
    {
        return GreenSpace::findOrFail($id);
    }

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

    public function destroy($id)
    {
        $greenSpace = GreenSpace::findOrFail($id);
        $greenSpace->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function book($id)
    {
        $greenSpace = GreenSpace::findOrFail($id);

        if (!$greenSpace->availability) {
            return response()->json(['error' => 'This green space is not available'], 400);
        }

        $greenSpace->update(['availability' => false]);

        return response()->json([
            'message' => 'Green space booked successfully',
            'greenSpace' => $greenSpace
        ]);
    }
}
