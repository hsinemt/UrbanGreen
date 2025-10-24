<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    private $apiKey;

    private $baseUrl;

    public function __construct()
    {
        $this->apiKey = '75ca7bcef4d9c917037eafbb98b9a04b';
        $this->baseUrl = 'https://api.openweathermap.org/data/2.5';
    }

    /**
     * Get weather data for a specific location and date
     */
    public function getWeatherForEvent($location, $date)
    {
        try {
            // First, get coordinates for the location
            $coordinates = $this->getCoordinates($location);

            if (! $coordinates) {
                return null;
            }

            $eventDate = Carbon::parse($date);
            $now = Carbon::now();

            // If the event date is today or in the future (within 5 days), get forecast
            if ($eventDate->isToday() || ($eventDate->isFuture() && $eventDate->diffInDays($now) <= 5)) {
                return $this->getForecastWeather($coordinates['lat'], $coordinates['lon'], $eventDate);
            }
            // If the event date is in the past or more than 5 days future, get current weather
            else {
                return $this->getCurrentWeather($coordinates['lat'], $coordinates['lon']);
            }

        } catch (\Exception $e) {
            Log::error('Weather API Error: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Get coordinates for a location using Geocoding API
     */
    private function getCoordinates($location)
    {
        try {
            $response = Http::withoutVerifying()->timeout(10)->get($this->baseUrl.'/weather', [
                'q' => $location,
                'appid' => $this->apiKey,
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'lat' => $data['coord']['lat'],
                    'lon' => $data['coord']['lon'],
                    'city' => $data['name'],
                    'country' => $data['sys']['country'],
                ];
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Geocoding API Error: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Get current weather data
     */
    private function getCurrentWeather($lat, $lon)
    {
        try {
            $response = Http::withoutVerifying()->timeout(10)->get($this->baseUrl.'/weather', [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $this->apiKey,
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return $this->formatWeatherData($data);
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Current Weather API Error: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Get forecast weather data for a specific date
     */
    private function getForecastWeather($lat, $lon, $targetDate)
    {
        try {
            $response = Http::withoutVerifying()->timeout(10)->get($this->baseUrl.'/forecast', [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $this->apiKey,
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Find the closest forecast to the target date
                $closestForecast = $this->findClosestForecast($data['list'], $targetDate);

                if ($closestForecast) {
                    return $this->formatWeatherData($closestForecast);
                }
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Forecast Weather API Error: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Find the closest forecast to the target date
     */
    private function findClosestForecast($forecasts, $targetDate)
    {
        $closest = null;
        $minDiff = PHP_INT_MAX;

        foreach ($forecasts as $forecast) {
            $forecastDate = Carbon::parse($forecast['dt_txt']);
            $diff = abs($forecastDate->diffInHours($targetDate));

            if ($diff < $minDiff) {
                $minDiff = $diff;
                $closest = $forecast;
            }
        }

        return $closest;
    }

    /**
     * Format weather data for display
     */
    private function formatWeatherData($data)
    {
        return [
            'temperature' => round($data['main']['temp']),
            'feels_like' => round($data['main']['feels_like']),
            'humidity' => $data['main']['humidity'],
            'pressure' => $data['main']['pressure'],
            'description' => ucfirst($data['weather'][0]['description']),
            'icon' => $data['weather'][0]['icon'],
            'wind_speed' => isset($data['wind']['speed']) ? round($data['wind']['speed']) : null,
            'wind_direction' => isset($data['wind']['deg']) ? $data['wind']['deg'] : null,
            'visibility' => isset($data['visibility']) ? round($data['visibility'] / 1000, 1) : null,
            'clouds' => isset($data['clouds']['all']) ? $data['clouds']['all'] : null,
            'date' => isset($data['dt_txt']) ? Carbon::parse($data['dt_txt'])->format('M d, Y H:i') : Carbon::now()->format('M d, Y H:i'),
        ];
    }

    /**
     * Get weather icon URL
     */
    public function getWeatherIconUrl($iconCode)
    {
        return "https://openweathermap.org/img/wn/{$iconCode}@2x.png";
    }

    /**
     * Get weather description with emoji
     */
    public function getWeatherEmoji($description)
    {
        $emojis = [
            'clear sky' => '☀️',
            'few clouds' => '⛅',
            'scattered clouds' => '☁️',
            'broken clouds' => '☁️',
            'overcast clouds' => '☁️',
            'shower rain' => '🌦️',
            'rain' => '🌧️',
            'thunderstorm' => '⛈️',
            'snow' => '❄️',
            'mist' => '🌫️',
            'fog' => '🌫️',
            'haze' => '🌫️',
            'dust' => '🌪️',
            'sand' => '🌪️',
            'ash' => '🌋',
            'squall' => '💨',
            'tornado' => '🌪️',
        ];

        $description = strtolower($description);

        foreach ($emojis as $key => $emoji) {
            if (strpos($description, $key) !== false) {
                return $emoji;
            }
        }

        return '🌤️'; // Default emoji
    }
}
