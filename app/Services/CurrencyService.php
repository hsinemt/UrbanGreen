<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    protected $apiKey;

    protected $baseUrl;

    protected $cacheKey = 'currency_rates';

    protected $cacheDuration = 300; // 5 minutes pour des taux en temps réel

    public function __construct()
    {
        $this->apiKey = config('services.fixer.api_key');
        $this->baseUrl = 'http://data.fixer.io/api/';
    }

    /**
     * Obtenir les taux de change depuis l'API Fixer.io (temps réel)
     */
    public function getExchangeRates($baseCurrency = 'EUR')
    {
        $cacheKey = $this->cacheKey.'_'.$baseCurrency.'_'.date('Y-m-d-H-i');

        return Cache::remember($cacheKey, $this->cacheDuration, function () use ($baseCurrency) {
            try {
                // Essayer d'abord Fixer.io (temps réel)
                $response = Http::timeout(10)->get($this->baseUrl.'latest', [
                    'access_key' => $this->apiKey,
                    'base' => $baseCurrency,
                    'symbols' => 'USD,EUR,GBP,CHF,TND,CAD,AUD,JPY,CNY,AED,SAR,EGP,MAD,DZD',
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if ($data['success']) {
                        Log::info('Currency rates updated from Fixer.io', ['base' => $baseCurrency]);

                        return [
                            'base' => $data['base'],
                            'date' => $data['date'],
                            'rates' => $data['rates'],
                        ];
                    }
                }

                // Fallback vers ExchangeRate-API
                $fallbackResponse = Http::timeout(10)->get('https://api.exchangerate-api.com/v4/latest/'.$baseCurrency);

                if ($fallbackResponse->successful()) {
                    $fallbackData = $fallbackResponse->json();
                    Log::info('Currency rates updated from ExchangeRate-API (fallback)', ['base' => $baseCurrency]);

                    return $fallbackData;
                }

                Log::error('All currency APIs failed');

                return $this->getFallbackRates();

            } catch (\Exception $e) {
                Log::error('Currency API error', ['error' => $e->getMessage()]);

                return $this->getFallbackRates();
            }
        });
    }

    /**
     * Convertir un montant d'une devise à une autre
     */
    public function convert($amount, $fromCurrency, $toCurrency)
    {
        if ($fromCurrency === $toCurrency) {
            return $amount;
        }

        $rates = $this->getExchangeRates($fromCurrency);

        if (isset($rates['rates'][$toCurrency])) {
            return $amount * $rates['rates'][$toCurrency];
        }

        // Si la conversion directe n'est pas disponible, essayer via EUR
        if ($fromCurrency !== 'EUR' && $toCurrency !== 'EUR') {
            $eurAmount = $this->convert($amount, $fromCurrency, 'EUR');

            return $this->convert($eurAmount, 'EUR', $toCurrency);
        }

        return null;
    }

    /**
     * Convertir vers TND (devise de base)
     */
    public function convertToTND($amount, $fromCurrency)
    {
        return $this->convert($amount, $fromCurrency, 'TND');
    }

    /**
     * Obtenir le taux de change entre deux devises
     */
    public function getRate($fromCurrency, $toCurrency)
    {
        $rates = $this->getExchangeRates($fromCurrency);

        if (isset($rates['rates'][$toCurrency])) {
            return $rates['rates'][$toCurrency];
        }

        return null;
    }

    /**
     * Taux de change de secours en cas d'échec de l'API
     */
    protected function getFallbackRates()
    {
        return [
            'base' => 'EUR',
            'date' => now()->format('Y-m-d'),
            'rates' => [
                'USD' => 1.08,
                'EUR' => 1.0,
                'GBP' => 0.85,
                'CHF' => 0.95,
                'TND' => 3.3,
                'CAD' => 1.45,
                'AUD' => 1.65,
                'JPY' => 160.0,
                'CNY' => 7.8,
                'AED' => 3.97,
                'SAR' => 4.05,
                'EGP' => 33.0,
                'MAD' => 10.8,
                'DZD' => 145.0,
            ],
        ];
    }

    /**
     * Forcer la mise à jour des taux de change
     */
    public function refreshRates($baseCurrency = 'EUR')
    {
        $cacheKey = $this->cacheKey.'_'.$baseCurrency.'_'.date('Y-m-d-H-i');
        Cache::forget($cacheKey);

        return $this->getExchangeRates($baseCurrency);
    }

    /**
     * Obtenir toutes les devises supportées
     */
    public function getSupportedCurrencies()
    {
        return [
            'TND' => 'Dinar Tunisien',
            'USD' => 'Dollar US',
            'EUR' => 'Euro',
            'GBP' => 'Livre Sterling',
            'CHF' => 'Franc Suisse',
            'CAD' => 'Dollar Canadien',
            'AUD' => 'Dollar Australien',
            'JPY' => 'Yen Japonais',
            'CNY' => 'Yuan Chinois',
            'AED' => 'Dirham Émirati',
            'SAR' => 'Riyal Saoudien',
            'EGP' => 'Livre Égyptienne',
            'MAD' => 'Dirham Marocain',
            'DZD' => 'Dinar Algérien',
        ];
    }

    /**
     * Formater un montant avec la devise
     */
    public function formatAmount($amount, $currency)
    {
        $symbols = [
            'TND' => 'د.ت',
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'CHF' => 'CHF',
            'CAD' => 'C$',
            'AUD' => 'A$',
            'JPY' => '¥',
            'CNY' => '¥',
            'AED' => 'د.إ',
            'SAR' => 'ر.س',
            'EGP' => '£',
            'MAD' => 'د.م.',
            'DZD' => 'د.ج',
        ];

        $symbol = $symbols[$currency] ?? $currency;

        return $symbol.' '.number_format($amount, 2);
    }

    /**
     * Obtenir les taux de change en temps réel pour le front office
     */
    public function getLiveRates()
    {
        try {
            // Utiliser une API gratuite pour les taux en temps réel
            $response = Http::timeout(5)->get('https://api.exchangerate-api.com/v4/latest/EUR');

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'success' => true,
                    'base' => $data['base'],
                    'date' => $data['date'],
                    'rates' => $data['rates'],
                ];
            }

            return ['success' => false, 'message' => 'API non disponible'];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
