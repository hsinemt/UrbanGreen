<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\Event;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Wallet::with('event');

        if ($request->filled('q')) {
            $q = $request->get('q');
            $query->where(function($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%");
            });
        }

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->get('event_id'));
        }

        $wallets = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $events = Event::orderBy('name')->get(['id','name']);

        $stats = [
            'count' => Wallet::count(),
            'total_collected' => Wallet::sum('total_amount'),
            'total_target' => Wallet::sum('target_amount'),
            'avg_progress' => Wallet::selectRaw('AVG(CASE WHEN target_amount>0 THEN (total_amount/target_amount)*100 ELSE 0 END) as avg_prog')->value('avg_prog'),
        ];

        return view('dashboard.wallets.index', compact('wallets','events','stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        return view('dashboard.wallets.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'event_id' => 'required|exists:events,id'
        ]);

        Wallet::create($request->all());

        return redirect()->route('admin.wallets.index')
            ->with('success', 'Wallet créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        $wallet->load(['event', 'donations']);
        return view('dashboard.wallets.show', compact('wallet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        $events = Event::all();
        return view('dashboard.wallets.edit', compact('wallet', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'event_id' => 'required|exists:events,id'
        ]);

        $wallet->update($request->all());

        return redirect()->route('admin.wallets.index')
            ->with('success', 'Wallet mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        $wallet->delete();

        return redirect()->route('admin.wallets.index')
            ->with('success', 'Wallet supprimé avec succès.');
    }
}
