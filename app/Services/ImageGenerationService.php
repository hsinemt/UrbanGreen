<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageGenerationService
{
    /**
     * Generate an image for an event using multiple fallback methods
     */
    public function generateEventImage($eventName, $eventDescription = null, $location = null)
    {
        // Try Freepik API first
        $freepikService = new FreepikImageService;
        $image = $freepikService->generateEventImage($eventName, $eventDescription, $location);

        if ($image) {
            return $image;
        }

        // Fallback: Try Unsplash API for a themed image
        $image = $this->generateFromUnsplash($eventName, $eventDescription, $location);

        if ($image) {
            return $image;
        }

        // Final fallback: Create a simple placeholder
        return $this->createPlaceholderImage($eventName);
    }

    /**
     * Generate image from Unsplash as fallback
     */
    private function generateFromUnsplash($eventName, $eventDescription = null, $location = null)
    {
        try {
            // Create search query based on event details
            $query = $this->createSearchQuery($eventName, $eventDescription, $location);

            $response = Http::timeout(10)
                ->withOptions([
                    'verify' => config('app.ssl_verify', true),
                ])
                ->get('https://api.unsplash.com/search/photos', [
                    'query' => $query,
                    'per_page' => 1,
                    'orientation' => 'landscape',
                ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['results'][0]['urls']['regular'])) {
                    $imageUrl = $data['results'][0]['urls']['regular'];

                    // Download and store the image
                    $imageResponse = Http::timeout(10)
                        ->withOptions([
                            'verify' => config('app.ssl_verify', true),
                        ])
                        ->get($imageUrl);

                    if ($imageResponse->successful()) {
                        $imageContent = $imageResponse->body();
                        $filename = 'events/'.uniqid().'_'.time().'.jpg';

                        $stored = Storage::disk('public')->put($filename, $imageContent);

                        if ($stored) {
                            Log::info('Unsplash image stored successfully', ['filename' => $filename]);

                            return $filename;
                        }
                    }
                }
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Unsplash API Error: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Create a placeholder image
     */
    private function createPlaceholderImage($eventName)
    {
        try {
            // Create a simple SVG placeholder
            $svg = $this->createSVGPlaceholder($eventName);

            $filename = 'events/'.uniqid().'_'.time().'.svg';
            $stored = Storage::disk('public')->put($filename, $svg);

            if ($stored) {
                Log::info('Placeholder image created', ['filename' => $filename]);

                return $filename;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Placeholder creation error: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Create SVG placeholder
     */
    private function createSVGPlaceholder($eventName)
    {
        $colors = ['#28a745', '#007bff', '#6f42c1', '#fd7e14', '#20c997'];
        $color = $colors[array_rand($colors)];

        return '<?xml version="1.0" encoding="UTF-8"?>
<svg width="400" height="300" xmlns="http://www.w3.org/2000/svg">
  <rect width="400" height="300" fill="'.$color.'" opacity="0.1"/>
  <rect x="20" y="20" width="360" height="260" fill="none" stroke="'.$color.'" stroke-width="2"/>
  <text x="200" y="150" text-anchor="middle" font-family="Arial, sans-serif" font-size="24" font-weight="bold" fill="'.$color.'">
    '.htmlspecialchars($eventName).'
  </text>
  <text x="200" y="180" text-anchor="middle" font-family="Arial, sans-serif" font-size="14" fill="'.$color.'" opacity="0.7">
    Event Image
  </text>
</svg>';
    }

    /**
     * Create search query for Unsplash
     */
    private function createSearchQuery($eventName, $eventDescription = null, $location = null)
    {
        $query = 'event';

        if ($eventDescription) {
            $themes = $this->extractThemes($eventDescription);
            if (! empty($themes)) {
                $query .= ' '.implode(' ', $themes);
            }
        }

        if ($location) {
            $query .= ' '.$location;
        }

        return $query;
    }

    /**
     * Extract themes from description
     */
    private function extractThemes($description)
    {
        $themes = [];
        $description = strtolower($description);

        $themeKeywords = [
            'nature' => ['green', 'eco', 'environment', 'sustainability', 'nature', 'climate', 'tree', 'forest'],
            'charity' => ['charity', 'donation', 'help', 'support', 'fundraising'],
            'community' => ['community', 'local', 'neighborhood', 'social'],
            'education' => ['education', 'learning', 'workshop', 'training', 'seminar'],
            'health' => ['health', 'wellness', 'fitness', 'medical'],
            'technology' => ['tech', 'digital', 'innovation', 'ai', 'software'],
            'art' => ['art', 'creative', 'design', 'culture', 'music'],
            'business' => ['business', 'networking', 'conference', 'meeting'],
        ];

        foreach ($themeKeywords as $theme => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($description, $keyword) !== false) {
                    $themes[] = $theme;
                    break;
                }
            }
        }

        return array_unique($themes);
    }
}
