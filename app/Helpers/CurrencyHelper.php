<?php

namespace App\Helpers;

use App\Services\CurrencyService;

class CurrencyHelper
{
    /**
     * Taux de change fixes vers le Dinar Tunisien (TND) - Fallback
     * Convertir vers TND = multiplié par le taux
     */
    private static $fallbackRates = [
        'TND' => 1.0,      // Monnaie de base
        'EUR' => 3.3,      // 1 EUR = 3.3 TND
        'USD' => 2.9,      // 1 USD = 2.9 TND
        'GBP' => 3.7,      // 1 GBP = 3.7 TND (approximatif)
        'CHF' => 3.2,      // 1 CHF = 3.2 TND (approximatif)
    ];

    /**
     * Convertit un montant vers le Dinar Tunisien en utilisant l'API ou les taux de secours
     */
    public static function convertToTND($amount, $fromCurrency)
    {
        if ($fromCurrency === 'TND') {
            return $amount;
        }

        try {
            $currencyService = app(CurrencyService::class);
            $convertedAmount = $currencyService->convertToTND($amount, $fromCurrency);
            
            if ($convertedAmount !== null) {
                return round($convertedAmount, 3);
            }
        } catch (\Exception $e) {
            // En cas d'erreur, utiliser les taux de secours
        }

        // Utiliser les taux de secours
        if (!isset(self::$fallbackRates[$fromCurrency])) {
            return $amount; // Si aucun taux de conversion trouvé, retourner le montant original
        }

        return round($amount * self::$fallbackRates[$fromCurrency], 3);
    }

    /**
     * Formate un montant en Dinar Tunisien
     */
    public static function formatTND($amount)
    {
        return number_format($amount, 3) . ' د.ت';
    }

    /**
     * Calcule la somme totale en TND d'une collection de donations
     */
    public static function calculateTotalInTND($donations)
    {
        $total = 0;
        foreach ($donations as $donation) {
            $total += self::convertToTND($donation->amount, $donation->currency);
        }
        return round($total, 3);
    }

    /**
     * Obtient le taux de change vers TND (en temps réel ou de secours)
     */
    public static function getExchangeRate($currency)
    {
        if ($currency === 'TND') {
            return 1.0;
        }

        try {
            $currencyService = app(CurrencyService::class);
            $rate = $currencyService->getRate($currency, 'TND');
            
            if ($rate !== null) {
                return $rate;
            }
        } catch (\Exception $e) {
            // En cas d'erreur, utiliser les taux de secours
        }

        return self::$fallbackRates[$currency] ?? 1.0;
    }

    /**
     * Obtient tous les taux de change (en temps réel ou de secours)
     */
    public static function getAllExchangeRates()
    {
        try {
            $currencyService = app(CurrencyService::class);
            $rates = $currencyService->getExchangeRates('TND');
            
            if (isset($rates['rates'])) {
                return array_merge(['TND' => 1.0], $rates['rates']);
            }
        } catch (\Exception $e) {
            // En cas d'erreur, utiliser les taux de secours
        }

        return self::$fallbackRates;
    }

    /**
     * Formate les statistiques par devise pour l'affichage en TND
     */
    public static function getStatisticsByCurrency($donations)
    {
        $statistics = [];
        
        foreach ($donations->groupBy('currency') as $currency => $currencyDonations) {
            $totalInOriginalCurrency = $currencyDonations->sum('amount');
            $totalInTND = self::convertToTND($totalInOriginalCurrency, $currency);
            $count = $currencyDonations->count();
            
            $statistics[$currency] = [
                'currency' => $currency,
                'count' => $count,
                'amount_original' => $totalInOriginalCurrency,
                'amount_tnd' => $totalInTND,
                'exchange_rate' => self::getExchangeRate($currency)
            ];
        }
        
        return $statistics;
    }

    /**
     * Convertit un montant entre deux devises
     */
    public static function convert($amount, $fromCurrency, $toCurrency)
    {
        if ($fromCurrency === $toCurrency) {
            return $amount;
        }

        try {
            $currencyService = app(CurrencyService::class);
            $convertedAmount = $currencyService->convert($amount, $fromCurrency, $toCurrency);
            
            if ($convertedAmount !== null) {
                return round($convertedAmount, 3);
            }
        } catch (\Exception $e) {
            // En cas d'erreur, utiliser les taux de secours
        }

        // Utiliser les taux de secours pour la conversion
        $fromRate = self::$fallbackRates[$fromCurrency] ?? 1.0;
        $toRate = self::$fallbackRates[$toCurrency] ?? 1.0;
        
        // Convertir via TND
        $amountInTND = $amount * $fromRate;
        return round($amountInTND / $toRate, 3);
    }

    /**
     * Formate un montant avec la devise
     */
    public static function formatAmount($amount, $currency)
    {
        try {
            $currencyService = app(CurrencyService::class);
            return $currencyService->formatAmount($amount, $currency);
        } catch (\Exception $e) {
            // Formatage de secours
            $symbols = [
                'TND' => 'د.ت',
                'USD' => '$',
                'EUR' => '€',
                'GBP' => '£',
                'CHF' => 'CHF',
            ];
            
            $symbol = $symbols[$currency] ?? $currency;
            return $symbol . ' ' . number_format($amount, 2);
        }
    }

    /**
     * Force la mise à jour des taux de change
     */
    public static function refreshRates()
    {
        try {
            $currencyService = app(CurrencyService::class);
            return $currencyService->refreshRates();
        } catch (\Exception $e) {
            return false;
        }
    }
}
