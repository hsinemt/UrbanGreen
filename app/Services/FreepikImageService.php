<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FreepikImageService
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->apiKey = 'FPSX56195d43aac08ec816533d1e893fd714';
        $this->baseUrl = 'https://api.freepik.com/v1/ai/mystic';
    }

    /**
     * Generate an AI image based on event details
     */
    public function generateEventImage($eventName, $eventDescription = null, $location = null)
    {
        try {
            // Create a descriptive prompt based on event details
            $prompt = $this->createPrompt($eventName, $eventDescription, $location);
            
            Log::info('Freepik API Request', [
                'url' => $this->baseUrl,
                'prompt' => $prompt,
                'api_key' => substr($this->apiKey, 0, 10) . '...'
            ]);
            
            // Step 1: Create the image generation task
            $response = Http::timeout(30)->withHeaders([
                'x-freepik-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->post($this->baseUrl, [
                'prompt' => $prompt,
                'style' => 'realistic',
                'quality' => 'high',
                'size' => '1024x1024'
            ]);

            Log::info('Freepik API Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Freepik API Response Data', $data);
                
                // Check if we got a task ID (asynchronous processing)
                if (isset($data['data']['task_id'])) {
                    $taskId = $data['data']['task_id'];
                    Log::info('Task created, polling for result', ['task_id' => $taskId]);
                    
                    // Step 2: Poll for the result
                    return $this->pollForImageResult($taskId);
                }
                
                // Check for immediate result (synchronous processing)
                $imageUrl = null;
                if (isset($data['data']['url'])) {
                    $imageUrl = $data['data']['url'];
                } elseif (isset($data['url'])) {
                    $imageUrl = $data['url'];
                } elseif (isset($data['image_url'])) {
                    $imageUrl = $data['image_url'];
                } elseif (isset($data['data']['image_url'])) {
                    $imageUrl = $data['data']['image_url'];
                }
                
                if ($imageUrl) {
                    return $this->downloadAndStoreImage($imageUrl);
                }
            }
            
            Log::error('Freepik API request failed', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('Freepik API Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    /**
     * Poll for image generation result
     */
    private function pollForImageResult($taskId)
    {
        $maxAttempts = 10; // Maximum 10 attempts (50 seconds total)
        $attempt = 0;
        
        while ($attempt < $maxAttempts) {
            $attempt++;
            
            Log::info('Polling attempt', ['attempt' => $attempt, 'task_id' => $taskId]);
            
            try {
                $response = Http::timeout(10)->withHeaders([
                    'x-freepik-api-key' => $this->apiKey,
                    'Accept' => 'application/json'
                ])->get($this->baseUrl . '/' . $taskId);
                
                if ($response->successful()) {
                    $data = $response->json();
                    
                    Log::info('Polling response', $data);
                    
                    if (isset($data['data']['status'])) {
                        $status = $data['data']['status'];
                        
                        if ($status === 'COMPLETED' && isset($data['data']['generated']) && !empty($data['data']['generated'])) {
                            // Image is ready
                            $generatedImages = $data['data']['generated'];
                            
                            // Handle both string URLs and object URLs
                            $imageUrl = null;
                            if (is_string($generatedImages[0])) {
                                $imageUrl = $generatedImages[0];
                            } elseif (is_array($generatedImages[0]) && isset($generatedImages[0]['url'])) {
                                $imageUrl = $generatedImages[0]['url'];
                            }
                            
                            if ($imageUrl) {
                                Log::info('Image generation completed', ['url' => $imageUrl]);
                                return $this->downloadAndStoreImage($imageUrl);
                            }
                        } elseif ($status === 'FAILED') {
                            Log::error('Image generation failed', $data);
                            return null;
                        } elseif ($status === 'PROCESSING' || $status === 'CREATED') {
                            // Still processing, wait and try again
                            sleep(5);
                            continue;
                        }
                    }
                }
                
                // Wait before next attempt
                sleep(5);
                
            } catch (\Exception $e) {
                Log::error('Polling error: ' . $e->getMessage());
                sleep(5);
            }
        }
        
        Log::error('Image generation timeout after maximum attempts');
        return null;
    }

    /**
     * Download and store image from URL
     */
    private function downloadAndStoreImage($imageUrl)
    {
        try {
            Log::info('Downloading image', ['url' => $imageUrl]);
            
            $imageResponse = Http::timeout(30)->get($imageUrl);
            
            if ($imageResponse->successful()) {
                $imageContent = $imageResponse->body();
                
                // Generate a unique filename
                $filename = 'events/' . uniqid() . '_' . time() . '.jpg';
                
                // Store the image
                $stored = Storage::disk('public')->put($filename, $imageContent);
                
                if ($stored) {
                    Log::info('Image stored successfully', ['filename' => $filename]);
                    return $filename;
                } else {
                    Log::error('Failed to store image to storage');
                }
            } else {
                Log::error('Failed to download image', [
                    'status' => $imageResponse->status(),
                    'url' => $imageUrl
                ]);
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error('Image download error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create a descriptive prompt for the AI image generation
     */
    private function createPrompt($eventName, $eventDescription = null, $location = null)
    {
        $prompt = "Professional event poster for: " . $eventName;
        
        if ($location) {
            $prompt .= " at " . $location;
        }
        
        if ($eventDescription) {
            // Extract key themes from description
            $themes = $this->extractThemes($eventDescription);
            if (!empty($themes)) {
                $prompt .= ". Theme: " . implode(', ', $themes);
            }
        }
        
        $prompt .= ". Modern, clean design with vibrant colors, professional typography, event poster style, high quality, detailed";
        
        return $prompt;
    }

    /**
     * Extract themes/keywords from event description
     */
    private function extractThemes($description)
    {
        $themes = [];
        $description = strtolower($description);
        
        // Common event themes
        $themeKeywords = [
            'environment' => ['green', 'eco', 'environment', 'sustainability', 'nature', 'climate'],
            'charity' => ['charity', 'donation', 'help', 'support', 'fundraising'],
            'community' => ['community', 'local', 'neighborhood', 'social'],
            'education' => ['education', 'learning', 'workshop', 'training', 'seminar'],
            'health' => ['health', 'wellness', 'fitness', 'medical'],
            'technology' => ['tech', 'digital', 'innovation', 'ai', 'software'],
            'art' => ['art', 'creative', 'design', 'culture', 'music'],
            'business' => ['business', 'networking', 'conference', 'meeting']
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
