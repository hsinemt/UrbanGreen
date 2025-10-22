<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CurrencyService;
use App\Helpers\CurrencyHelper;

class CurrencyController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Afficher la page des taux de change pour les donateurs
     */
    public function index()
    {
        try {
            $liveRates = $this->currencyService->getLiveRates();
            $supportedCurrencies = $this->currencyService->getSupportedCurrencies();
            
            return view('frontOffice.currency.index', compact('liveRates', 'supportedCurrencies'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du chargement des taux de change: ' . $e->getMessage());
        }
    }

    /**
     * Convertir un montant via AJAX (pour les donateurs)
     */
    public function convert(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'from' => 'required|string|size:3',
            'to' => 'required|string|size:3'
        ]);

        try {
            $convertedAmount = $this->currencyService->convert(
                $request->amount,
                $request->from,
                $request->to
            );

            if ($convertedAmount !== null) {
                return response()->json([
                    'success' => true,
                    'amount' => $convertedAmount,
                    'formatted' => $this->currencyService->formatAmount($convertedAmount, $request->to),
                    'rate' => $this->currencyService->getRate($request->from, $request->to)
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Conversion impossible'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la conversion: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtenir les taux de change en temps réel via AJAX
     */
    public function getRates(Request $request)
    {
        try {
            $baseCurrency = $request->get('base', 'EUR');
            $rates = $this->currencyService->getLiveRates();
            
            return response()->json([
                'success' => true,
                'rates' => $rates
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du chargement des taux: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtenir le taux de change pour une paire de devises spécifique
     */
    public function getRate(Request $request)
    {
        $request->validate([
            'from' => 'required|string|size:3',
            'to' => 'required|string|size:3'
        ]);

        try {
            $rate = $this->currencyService->getRate($request->from, $request->to);
            
            if ($rate !== null) {
                return response()->json([
                    'success' => true,
                    'rate' => $rate,
                    'from' => $request->from,
                    'to' => $request->to
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Taux de change non disponible'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du chargement du taux: ' . $e->getMessage()
            ], 500);
        }
    }
}