<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Wallet;
use App\Models\Event;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class DonationController extends Controller
{
    /**
     * Display a listing of donations.
     */
    public function index(Request $request)
    {
        $query = Donation::with('wallet.event');
        
        // Filtre par devise
        if ($request->filled('currency')) {
            $query->where('currency', $request->currency);
        }
        
        // Filtre par méthode de paiement
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }
        
        // Filtre par wallet
        if ($request->filled('wallet_id')) {
            $query->where('wallet_id', $request->wallet_id);
        }
        
        $donations = $query->orderBy('date', 'desc')->get();
        
        // Obtenir les options pour les filtres
        $currencies = Donation::select('currency')->distinct()->pluck('currency')->sort();
        $paymentMethods = Donation::select('payment_method')->distinct()->pluck('payment_method')->sort();
        $wallets = Wallet::with('event')->get();
        
        // Calculer les statistiques en TND
        $totalAmountTND = CurrencyHelper::calculateTotalInTND($donations);
        $statisticsByCurrency = CurrencyHelper::getStatisticsByCurrency($donations);
        
        return view('frontOffice.donations.index', compact(
            'donations', 
            'currencies', 
            'paymentMethods',
            'wallets',
            'totalAmountTND', 
            'statisticsByCurrency'
        ));
    }

    /**
     * Show the form for creating a new donation.
     */
    public function create()
    {
        $wallets = Wallet::with('event')->get();
        return view('frontOffice.donations.create', compact('wallets'));
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
            'payment_method' => 'required|string|max:255',
            'wallet_id' => 'required|exists:wallets,id'
        ]);

        // Fallback non-Stripe (au cas où). Par défaut, on utilise Stripe via checkout()
        $donation = Donation::create($request->all());
        $wallet = Wallet::find($request->wallet_id);
        $wallet->increment('donation_count');
        $wallet->increment('total_amount', $request->amount);

        return redirect()->route('donations.index')->with('success', 'Donation ajoutée avec succès!');
    }

    /**
     * Crée une session Stripe Checkout et redirige l'utilisateur
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.5',
            'currency' => 'required|string|size:3',
            'date' => 'required|date',
            'payment_method' => 'required|string|max:255',
            'wallet_id' => 'required|exists:wallets,id'
        ]);

        $stripe = new StripeClient(config('services.stripe.secret'));

        // Stripe ne supporte pas TND. On convertit vers EUR pour le paiement.
        $amountInEur = CurrencyHelper::convert($validated['amount'], strtoupper($validated['currency']), 'EUR');
        $amountInEurCents = max(50, (int) round($amountInEur * 100)); // min 0.50 EUR

        $wallet = Wallet::with('event')->findOrFail($validated['wallet_id']);

        $session = $stripe->checkout->sessions->create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $amountInEurCents,
                    'product_data' => [
                        'name' => 'Donation - ' . ($wallet->event->name ?? 'Event') . ' / ' . $wallet->name,
                        'metadata' => [
                            'wallet_id' => (string) $wallet->id,
                        ],
                    ],
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('donations.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('donations.stripe.cancel'),
            'metadata' => [
                'wallet_id' => (string) $wallet->id,
                'original_amount' => (string) $validated['amount'],
                'original_currency' => strtoupper($validated['currency']),
                'payment_method_label' => $validated['payment_method'],
                'date' => $validated['date'],
            ],
        ]);

        return redirect($session->url);
    }

    /**
     * Succès Stripe: vérifier le paiement et enregistrer la donation
     */
    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            return redirect()->route('donations.index')->with('error', 'Session Stripe introuvable.');
        }

        $stripe = new StripeClient(config('services.stripe.secret'));
        $session = $stripe->checkout->sessions->retrieve($sessionId, ['expand' => ['payment_intent']]);

        if (!$session || $session->payment_status !== 'paid') {
            return redirect()->route('donations.index')->with('error', 'Paiement non confirmé.');
        }

        // Récupérer les métadonnées pour créer la donation dans la devise d'origine
        $meta = $session->metadata ?? new \stdClass();
        $walletId = (int) ($meta->wallet_id ?? 0);
        $originalAmount = (float) ($meta->original_amount ?? 0);
        $originalCurrency = (string) ($meta->original_currency ?? 'EUR');
        $paymentMethodLabel = (string) ($meta->payment_method_label ?? 'Stripe');
        $date = (string) ($meta->date ?? now()->toDateString());

        if ($walletId <= 0 || $originalAmount <= 0) {
            return redirect()->route('donations.index')->with('error', 'Données paiement incomplètes.');
        }

        // Créer la donation
        $donation = Donation::create([
            'amount' => $originalAmount,
            'currency' => strtoupper($originalCurrency),
            'date' => $date,
            'payment_method' => $paymentMethodLabel,
            'wallet_id' => $walletId,
        ]);

        // Mettre à jour le wallet
        $wallet = Wallet::find($walletId);
        if ($wallet) {
            $wallet->increment('donation_count');
            $wallet->increment('total_amount', $originalAmount);
        }

        return view('frontOffice.donations.payment_success', [
            'donation' => $donation,
            'session' => $session,
        ]);
    }

    /**
     * Annulation Stripe
     */
    public function cancel()
    {
        return view('frontOffice.donations.payment_cancel');
    }

    /**
     * Display the specified donation.
     */
    public function show(Donation $donation)
    {
        $donation->load('wallet.event');
        return view('frontOffice.donations.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified donation.
     */
    public function edit(Donation $donation)
    {
        $wallets = Wallet::with('event')->get();
        return view('frontOffice.donations.edit', compact('donation', 'wallets'));
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
            'payment_method' => 'required|string|max:255',
            'wallet_id' => 'required|exists:wallets,id'
        ]);

        $oldWallet = $donation->wallet;
        $oldAmount = $donation->amount;
        
        $donation->update($request->all());
        
        // Mettre à jour les statistiques des wallets
        if ($oldWallet && $oldWallet->id != $request->wallet_id) {
            // Retirer de l'ancien wallet
            $oldWallet->decrement('donation_count');
            $oldWallet->decrement('total_amount', $oldAmount);
            
            // Ajouter au nouveau wallet
            $newWallet = Wallet::find($request->wallet_id);
            $newWallet->increment('donation_count');
            $newWallet->increment('total_amount', $request->amount);
        } elseif ($oldWallet && $oldWallet->id == $request->wallet_id) {
            // Même wallet, ajuster seulement le montant
            $difference = $request->amount - $oldAmount;
            $oldWallet->increment('total_amount', $difference);
        }

        return redirect()->route('donations.index')
            ->with('success', 'Donation mise à jour avec succès!');
    }

    /**
     * Remove the specified donation from storage.
     */
    public function destroy(Donation $donation)
    {
        $wallet = $donation->wallet;
        
        $donation->delete();
        
        // Mettre à jour les statistiques du wallet
        if ($wallet) {
            $wallet->decrement('donation_count');
            $wallet->decrement('total_amount', $donation->amount);
        }

        return redirect()->route('donations.index')
            ->with('success', 'Donation supprimée avec succès!');
    }
}
