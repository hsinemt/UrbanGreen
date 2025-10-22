<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = Resource::with(['supplier', 'event'])->latest()->paginate(10);
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
        $resource->load(['supplier', 'event']);
        return view('dashboard.components.resources.show', compact('resource'));
    }

    /**
     * Get resource details as JSON for modal view.
     */
    public function details(Resource $resource)
    {
        $resource->load(['supplier', 'event']);

        return response()->json([
            'id' => $resource->id,
            'name' => $resource->name,
            'type' => $resource->type,
            'quantity' => $resource->quantity,
            'description' => $resource->description,
            'supplier' => $resource->supplier ? [
                'id' => $resource->supplier->id,
                'name' => $resource->supplier->display_name,
                'email' => $resource->supplier->email,
            ] : null,
            'event' => $resource->event ? [
                'id' => $resource->event->id,
                'name' => $resource->event->name,
                'date' => $resource->event->date,
            ] : null,
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

    /**
     * Show the form to add a resource to an event (Supplier only).
     */
    public function addToEvent(Event $event)
    {
        // Check if user is a supplier
        if (!Auth::check() || !Auth::user()->isSupplier()) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'Only suppliers can add resources to events.');
        }

        return view('frontOffice.pages.resource.add-resource', compact('event'));
    }

    /**
     * Store a resource for a specific event (Supplier only).
     */
    public function storeToEvent(Request $request, Event $event)
    {
        // Check if user is a supplier
        if (!Auth::check() || !Auth::user()->isSupplier()) {
            return redirect()->route('events.show', $event->id)
                ->with('error', 'Only suppliers can add resources to events.');
        }

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
            // Create the resource with supplier and event information
            $resource = Resource::create([
                'name' => $request->name,
                'type' => $request->type,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'supplier_id' => Auth::id(),
                'event_id' => $event->id,
            ]);

            return redirect()->route('events.show', $event->id)
                ->with('success', 'Resource added to event successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error adding resource: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Get all resources for a specific event.
     */
    public function getEventResources(Event $event)
    {
        $resources = Resource::forEvent($event->id)
            ->with('supplier')
            ->latest()
            ->get();

        return response()->json([
            'event' => [
                'id' => $event->id,
                'name' => $event->name,
            ],
            'resources' => $resources,
            'total_resources' => $resources->count(),
        ]);
    }

    /**
     * Show the form for editing the supplier's own resource.
     */
    public function editSupplier(Resource $resource)
    {
        // Check if user is the supplier who added this resource
        if (!Auth::check() || !Auth::user()->isSupplier() || $resource->supplier_id !== Auth::id()) {
            return redirect()->route('events.show', $resource->event_id)
                ->with('error', 'You can only edit your own resources.');
        }

        return view('frontOffice.pages.resource.edit-resource', compact('resource'));
    }

    /**
     * Update the supplier's own resource.
     */
    public function updateSupplier(Request $request, Resource $resource)
    {
        // Check if user is the supplier who added this resource
        if (!Auth::check() || !Auth::user()->isSupplier() || $resource->supplier_id !== Auth::id()) {
            return redirect()->route('events.show', $resource->event_id)
                ->with('error', 'You can only edit your own resources.');
        }

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
            $resource->update([
                'name' => $request->name,
                'type' => $request->type,
                'quantity' => $request->quantity,
                'description' => $request->description,
            ]);

            return redirect()->route('events.show', $resource->event_id)
                ->with('success', 'Resource updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating resource: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete the supplier's own resource.
     */
    public function destroySupplier(Resource $resource)
    {
        // Check if user is the supplier who added this resource
        if (!Auth::check() || !Auth::user()->isSupplier() || $resource->supplier_id !== Auth::id()) {
            return redirect()->route('events.show', $resource->event_id)
                ->with('error', 'You can only delete your own resources.');
        }

        try {
            $eventId = $resource->event_id;
            $resource->delete();

            return redirect()->route('events.show', $eventId)
                ->with('success', 'Resource deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting resource: ' . $e->getMessage());
        }
    }
}
