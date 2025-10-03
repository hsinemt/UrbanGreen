<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = Resource::latest()->paginate(10);
        return view('dashboard.components.resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.components.resources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            Resource::validationRules(),
            Resource::validationMessages()
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create the resource
            Resource::create($request->only(['name', 'type', 'quantity']));

            return redirect()->route('resources.index')
                ->with('success', 'Resource created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating resource: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return view('dashboard.components.resources.show', compact('resource'));
    }

    /**
     * Get resource details as JSON for modal view.
     */
    public function details(Resource $resource)
    {
        return response()->json([
            'id' => $resource->id,
            'name' => $resource->name,
            'type' => $resource->type,
            'quantity' => $resource->quantity,
            'created_at' => $resource->created_at->format('l, F j, Y \a\t g:i A'),
            'created_at_human' => $resource->created_at->diffForHumans(),
            'updated_at' => $resource->updated_at->format('l, F j, Y \a\t g:i A'),
            'updated_at_human' => $resource->updated_at->diffForHumans(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        return view('dashboard.components.resources.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        $validator = Validator::make(
            $request->all(),
            Resource::validationRules(),
            Resource::validationMessages()
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $resource->update($request->only(['name', 'type', 'quantity']));

            return redirect()->route('resources.index')
                ->with('success', 'Resource updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating resource: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        try {
            $resource->delete();

            return redirect()->route('resources.index')
                ->with('success', 'Resource deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting resource: ' . $e->getMessage());
        }
    }
}
