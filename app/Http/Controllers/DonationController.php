<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of donations.
     */
    public function index(Request $request)
    {
        $query = Donation::query();
        
        // Filtre par devise
        if ($request->filled('currency')) {
            $query->where('currency', $request->currency);
        }
        
        // Filtre par méthode de paiement
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }
        
        $donations = $query->orderBy('date', 'desc')->get();
        
        // Obtenir les options pour les filtres
        $currencies = Donation::select('currency')->distinct()->pluck('currency')->sort();
        $paymentMethods = Donation::select('payment_method')->distinct()->pluck('payment_method')->sort();
        
        // Calculer les statistiques en TND
        $totalAmountTND = CurrencyHelper::calculateTotalInTND($donations);
        $statisticsByCurrency = CurrencyHelper::getStatisticsByCurrency($donations);
        
        return view('frontOffice.donations.index', compact(
            'donations', 
            'currencies', 
            'paymentMethods', 
            'totalAmountTND', 
            'statisticsByCurrency'
        ));
    }

    /**
     * Show the form for creating a new donation.
     */
    public function create()
    {
        return view('frontOffice.donations.create');
    }

    /**
     * Store a newly created donation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'date' => 'required|date',
            'payment_method' => 'required|string|max:255'
        ]);

        Donation::create($request->all());

        return redirect()->route('donations.index')
            ->with('success', 'Donation ajoutée avec succès!');
    }

    /**
     * Display the specified donation.
     */
    public function show(Donation $donation)
    {
        return view('frontOffice.donations.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified donation.
     */
    public function edit(Donation $donation)
    {
        return view('frontOffice.donations.edit', compact('donation'));
    }

    /**
     * Update the specified donation in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'date' => 'required|date',
            'payment_method' => 'required|string|max:255'
        ]);

        $donation->update($request->all());

        return redirect()->route('donations.index')
            ->with('success', 'Donation mise à jour avec succès!');
    }

    /**
     * Remove the specified donation from storage.
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('donations.index')
            ->with('success', 'Donation supprimée avec succès!');
    }
}
