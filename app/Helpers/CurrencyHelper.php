<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * Taux de change fixes vers le Dinar Tunisien (TND)
     * Convertir vers TND = multiplié par le taux
     */
    private static $exchangeRates = [
        'TND' => 1.0,      // Monnaie de base
        'EUR' => 3.3,      // 1 EUR = 3.3 TND
        'USD' => 2.9,      // 1 USD = 2.9 TND
        'GBP' => 3.7,      // 1 GBP = 3.7 TND (approximatif)
        'CHF' => 3.2,      // 1 CHF = 3.2 TND (approximatif)
    ];

    /**
     * Convertit un montant vers le Dinar Tunisien
     */
    public static function convertToTND($amount, $fromCurrency)
    {
        if ($fromCurrency === 'TND') {
            return $amount;
        }

        if (!isset(self::$exchangeRates[$fromCurrency])) {
            return $amount; // Sin conversion rate found, return original amount
        }

        return round($amount * self::$exchangeRates[$fromCurrency], 3);
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
     * Obtient le taux de change vers TND
     */
    public static function getExchangeRate($currency)
    {
        return self::$exchangeRates[$currency] ?? 1.0;
    }

    /**
     * Obtenis tous les taux de change
     */
    public static function getAllExchangeRates()
    {
        return self::$exchangeRates;
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
}
