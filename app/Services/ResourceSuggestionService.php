<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Resource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Smart Resource Suggestion Service
 *
 * Suggests resources for events using:
 * 1. Historical data from similar past events
 * 2. Keyword matching based on event type
 * 3. AI enhancement when confidence is low
 */
class ResourceSuggestionService
{
    private const CACHE_DURATION = 15 * 60; // 15 minutes in seconds

    private const OPENAI_MODEL = 'gpt-3.5-turbo';

    private const API_TIMEOUT = 30; // 30 seconds timeout

    private const LOW_CONFIDENCE_THRESHOLD = 60; // Use AI when confidence < 60%

    private const TOP_SUGGESTIONS = 10; // Return top 10 suggestions

    /**
     * Keyword mappings for different event types
     * Maps keywords found in event name/description to suggested resources
     * Includes both compound phrases and individual keywords for flexible matching
     */
    private const KEYWORD_MAPPINGS = [
        // Compound phrases (exact match)
        'tree planting' => ['shovels', 'saplings', 'watering cans', 'gloves', 'mulch', 'stakes'],
        'beach cleanup' => ['trash bags', 'gloves', 'grabbers', 'bins', 'safety vests'],
        'park cleanup' => ['rakes', 'brooms', 'trash bags', 'gloves', 'wheelbarrows'],
        'community garden' => ['tools', 'seeds', 'soil', 'compost', 'watering equipment'],
        'trail maintenance' => ['tools', 'signs', 'gravel', 'wood chips'],
        'recycling drive' => ['bins', 'sorting tables', 'signs', 'gloves'],
        'forest restoration' => ['native plants', 'shovels', 'mulch', 'watering cans', 'protective gear'],
        'river cleanup' => ['nets', 'gloves', 'waders', 'trash bags', 'safety vests'],
        'erosion control' => ['sandbags', 'native plants', 'erosion blankets', 'stakes', 'tools'],
        'wildlife habitat' => ['nesting boxes', 'native plants', 'tools', 'signage'],
        'composting workshop' => ['compost bins', 'pitchforks', 'thermometers', 'educational materials'],
        'urban farming' => ['seeds', 'tools', 'irrigation systems', 'raised beds', 'soil'],
        'wetland restoration' => ['native wetland plants', 'waders', 'tools', 'marking stakes'],
        'pollution monitoring' => ['testing kits', 'protective gear', 'sampling containers', 'clipboards'],
        'green roof installation' => ['growing medium', 'native plants', 'drainage materials', 'tools'],

        // Individual keywords for flexible matching
        'tree' => ['shovels', 'saplings', 'watering cans', 'gloves', 'mulch', 'stakes'],
        'trees' => ['shovels', 'saplings', 'watering cans', 'gloves', 'mulch', 'stakes'],
        'planting' => ['shovels', 'saplings', 'watering cans', 'gloves', 'mulch', 'stakes'],
        'plant' => ['shovels', 'saplings', 'watering cans', 'gloves', 'mulch', 'stakes'],
        'saplings' => ['shovels', 'saplings', 'watering cans', 'gloves', 'mulch', 'stakes'],
        'sapling' => ['shovels', 'saplings', 'watering cans', 'gloves', 'mulch', 'stakes'],
        'seedling' => ['shovels', 'saplings', 'watering cans', 'gloves', 'mulch', 'stakes'],
        'seedlings' => ['shovels', 'saplings', 'watering cans', 'gloves', 'mulch', 'stakes'],
        'dig' => ['shovels', 'gloves', 'stakes'],
        'digging' => ['shovels', 'gloves', 'stakes'],
        'hole' => ['shovels', 'gloves'],
        'holes' => ['shovels', 'gloves'],
        'mulch' => ['mulch', 'shovels', 'wheelbarrows', 'gloves'],
        'watering' => ['watering cans', 'hoses', 'gloves'],
        'cleanup' => ['trash bags', 'gloves', 'grabbers', 'bins'],
        'clean' => ['trash bags', 'gloves', 'brooms', 'rakes'],
        'beach' => ['trash bags', 'gloves', 'grabbers', 'bins', 'safety vests'],
        'park' => ['rakes', 'brooms', 'trash bags', 'gloves', 'wheelbarrows'],
        'garden' => ['tools', 'seeds', 'soil', 'compost', 'watering equipment'],
        'gardening' => ['tools', 'seeds', 'soil', 'compost', 'watering equipment'],
        'volunteers' => ['gloves', 'safety vests', 'tools'],
        'volunteer' => ['gloves', 'safety vests', 'tools'],
    ];

    /**
     * Generate resource suggestions for an event.
     */
    public function suggest(Event $event): array
    {
        // Check cache first
        $cacheKey = "resource_suggestions_event_{$event->id}";

        $cached = Cache::get($cacheKey);
        if ($cached) {
            Log::info('Returning cached resource suggestions', ['event_id' => $event->id]);

            return $cached;
        }

        Log::info('Generating new resource suggestions', [
            'event_id' => $event->id,
            'event_name' => $event->name,
        ]);

        // Step 1: Get suggestions from historical data
        $historicalSuggestions = $this->getHistoricalSuggestions($event);
        Log::info('Historical suggestions retrieved', [
            'event_id' => $event->id,
            'count' => count($historicalSuggestions),
        ]);

        // Step 2: Get suggestions from keyword matching
        $keywordSuggestions = $this->getKeywordSuggestions($event);
        Log::info('Keyword suggestions retrieved', [
            'event_id' => $event->id,
            'count' => count($keywordSuggestions),
        ]);

        // Step 3: Merge and calculate confidence
        $mergedSuggestions = $this->mergeSuggestions($historicalSuggestions, $keywordSuggestions);
        Log::info('Suggestions merged', [
            'event_id' => $event->id,
            'total_count' => count($mergedSuggestions),
            'top_5_resources' => array_slice(array_column($mergedSuggestions, 'name'), 0, 5),
        ]);

        // Calculate overall confidence score
        $confidenceScore = $this->calculateOverallConfidence($mergedSuggestions);
        Log::info('Confidence score calculated', [
            'event_id' => $event->id,
            'confidence' => $confidenceScore,
        ]);

        // Step 4: Use AI enhancement if confidence is low OR no suggestions found
        $useAI = (empty($mergedSuggestions) || $confidenceScore < self::LOW_CONFIDENCE_THRESHOLD)
                 && ! empty(config('services.openai.api_key'));

        if ($useAI) {
            $reason = empty($mergedSuggestions) ? 'no suggestions found' : 'low confidence detected';
            Log::info("Using AI enhancement - {$reason}", [
                'event_id' => $event->id,
                'confidence' => $confidenceScore,
                'existing_suggestions_count' => count($mergedSuggestions),
            ]);

            try {
                $aiSuggestions = $this->getAISuggestions($event, $mergedSuggestions);
                $mergedSuggestions = $this->integrateAISuggestions($mergedSuggestions, $aiSuggestions);
                $confidenceScore = $this->calculateOverallConfidence($mergedSuggestions);

                Log::info('AI enhancement completed', [
                    'event_id' => $event->id,
                    'new_confidence' => $confidenceScore,
                    'total_suggestions' => count($mergedSuggestions),
                ]);
            } catch (\Exception $e) {
                Log::warning('AI enhancement failed, using base suggestions', [
                    'event_id' => $event->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        // Step 5: Get top suggestions with actual resource IDs from database
        $topSuggestions = $this->getTopSuggestionsWithIds($mergedSuggestions);

        Log::info('Final suggestions prepared', [
            'event_id' => $event->id,
            'final_count' => count($topSuggestions),
            'confidence_score' => round($confidenceScore, 2),
            'suggestions' => array_map(function ($s) {
                return ['name' => $s['name'], 'confidence' => $s['confidence']];
            }, $topSuggestions),
        ]);

        $result = [
            'suggestions' => $topSuggestions,
            'confidence_score' => round($confidenceScore, 2),
        ];

        // Cache the result
        Cache::put($cacheKey, $result, self::CACHE_DURATION);

        return $result;
    }

    /**
     * Get resource suggestions based on historical data from similar events.
     */
    private function getHistoricalSuggestions(Event $event): array
    {
        $suggestions = [];

        // Find similar past events based on name and description
        $eventText = strtolower($event->name.' '.$event->description);

        // Get past events (excluding current event)
        $pastEvents = Event::where('id', '!=', $event->id)
            ->where('date', '<', now())
            ->with(['resources' => function ($query) {
                $query->select('id', 'name', 'type', 'event_id')
                    ->groupBy('name', 'type', 'event_id', 'id');
            }])
            ->get();

        Log::info('Analyzing historical events', [
            'event_id' => $event->id,
            'past_events_count' => $pastEvents->count(),
        ]);

        $similarEvents = [];

        foreach ($pastEvents as $pastEvent) {
            $pastEventText = strtolower($pastEvent->name.' '.$pastEvent->description);

            // Calculate similarity using keyword overlap
            $similarity = $this->calculateTextSimilarity($eventText, $pastEventText);

            if ($similarity > 0) {
                $similarEvents[] = [
                    'id' => $pastEvent->id,
                    'name' => $pastEvent->name,
                    'similarity' => round($similarity, 2),
                    'resources_count' => $pastEvent->resources->count(),
                ];

                foreach ($pastEvent->resources as $resource) {
                    $resourceKey = strtolower(trim($resource->name));

                    if (! isset($suggestions[$resourceKey])) {
                        $suggestions[$resourceKey] = [
                            'name' => $resource->name,
                            'type' => $resource->type,
                            'score' => 0,
                            'source' => 'historical',
                        ];
                    }

                    // Increase score based on similarity with past event
                    $suggestions[$resourceKey]['score'] += $similarity * 50; // Max 50 points from historical
                }
            }
        }

        Log::info('Historical analysis completed', [
            'event_id' => $event->id,
            'similar_events_count' => count($similarEvents),
            'similar_events' => array_slice($similarEvents, 0, 5), // Log top 5
            'unique_resources_found' => count($suggestions),
        ]);

        return $suggestions;
    }

    /**
     * Get resource suggestions based on keyword matching.
     */
    private function getKeywordSuggestions(Event $event): array
    {
        $suggestions = [];
        $eventText = strtolower($event->name.' '.$event->description);

        // Log the event text being analyzed
        Log::info('Analyzing event for keyword matching', [
            'event_id' => $event->id,
            'event_name' => $event->name,
            'event_text_length' => strlen($eventText),
            'event_text_preview' => substr($eventText, 0, 200),
        ]);

        $matchedKeywords = [];

        foreach (self::KEYWORD_MAPPINGS as $keyword => $resources) {
            // Check if keyword exists in event text (case-insensitive using str_contains)
            if (str_contains($eventText, strtolower($keyword))) {
                $matchedKeywords[] = $keyword;

                Log::info('Keyword match found', [
                    'keyword' => $keyword,
                    'event_id' => $event->id,
                    'resources_count' => count($resources),
                ]);

                foreach ($resources as $resourceName) {
                    $resourceKey = strtolower(trim($resourceName));

                    if (! isset($suggestions[$resourceKey])) {
                        $suggestions[$resourceKey] = [
                            'name' => $resourceName,
                            'type' => 'equipment', // Default type
                            'score' => 0,
                            'source' => 'keyword',
                        ];
                    }

                    // Add 40 points for each keyword match
                    $suggestions[$resourceKey]['score'] += 40;
                }
            }
        }

        // Log summary of keyword matching
        Log::info('Keyword matching completed', [
            'event_id' => $event->id,
            'matched_keywords_count' => count($matchedKeywords),
            'matched_keywords' => $matchedKeywords,
            'unique_resources_found' => count($suggestions),
        ]);

        return $suggestions;
    }

    /**
     * Merge suggestions from different sources.
     */
    private function mergeSuggestions(array $historical, array $keyword): array
    {
        $merged = $historical;

        foreach ($keyword as $key => $suggestion) {
            if (isset($merged[$key])) {
                // Combine scores if resource exists in both sources
                $merged[$key]['score'] += $suggestion['score'];
                $merged[$key]['source'] = 'historical+keyword';
            } else {
                $merged[$key] = $suggestion;
            }
        }

        return $merged;
    }

    /**
     * Calculate overall confidence score based on all suggestions.
     */
    private function calculateOverallConfidence(array $suggestions): float
    {
        if (empty($suggestions)) {
            return 0;
        }

        $scores = array_column($suggestions, 'score');
        $maxScore = max($scores);
        $avgScore = array_sum($scores) / count($scores);

        // Confidence based on both max score and average score
        $confidence = min(100, ($maxScore * 0.6 + $avgScore * 0.4));

        return $confidence;
    }

    /**
     * Get AI-powered suggestions using OpenAI API.
     *
     * @throws \Exception
     */
    private function getAISuggestions(Event $event, array $existingSuggestions): array
    {
        $apiKey = config('services.openai.api_key') ?: env('OPENAI_API_KEY');

        if (! $apiKey) {
            throw new \Exception('OpenAI API key not configured');
        }

        // Prepare existing suggestions for context
        $existingNames = array_column($existingSuggestions, 'name');
        $existingContext = ! empty($existingNames)
            ? 'Current suggestions: '.implode(', ', $existingNames)
            : 'No suggestions found yet';

        // Build the prompt
        $prompt = "For an environmental event called '{$event->name}' with description: '{$event->description}', suggest 10 specific resources/equipment needed. Consider it's a greenspace management or environmental event. {$existingContext}. Return a JSON array with objects containing 'name' and 'type' fields.";

        $payload = [
            'model' => self::OPENAI_MODEL,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an expert in environmental projects and urban greenspace management. Suggest practical resources and equipment for environmental events. Always respond with valid JSON only.',
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            'temperature' => 0.7,
            'max_tokens' => 500,
        ];

        try {
            $response = Http::withOptions([
                'verify' => false,
            ])->withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(self::API_TIMEOUT)->post('https://api.openai.com/v1/chat/completions', $payload);

            if (! $response->successful()) {
                Log::error('OpenAI API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                throw new \Exception('Failed to get AI suggestions: '.$response->body());
            }

            $data = $response->json();
            $content = $data['choices'][0]['message']['content'] ?? null;

            if (! $content) {
                throw new \Exception('Invalid response from OpenAI API');
            }

            // Clean the content in case it has markdown code blocks
            $content = preg_replace('/```json\s*/', '', $content);
            $content = preg_replace('/```\s*/', '', $content);
            $content = trim($content);

            $aiData = json_decode($content, true);

            if (! $aiData) {
                Log::error('Failed to parse OpenAI response', ['content' => $content]);
                throw new \Exception('Failed to parse OpenAI response');
            }

            return $aiData;

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('OpenAI API connection timeout', ['error' => $e->getMessage()]);
            throw new \Exception('Request timed out. Please try again.');
        } catch (\Exception $e) {
            Log::error('OpenAI API call failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Integrate AI suggestions with existing suggestions.
     */
    private function integrateAISuggestions(array $existing, array $aiSuggestions): array
    {
        foreach ($aiSuggestions as $aiSuggestion) {
            if (! isset($aiSuggestion['name'])) {
                continue;
            }

            $resourceKey = strtolower(trim($aiSuggestion['name']));

            if (isset($existing[$resourceKey])) {
                // Boost existing suggestion score
                $existing[$resourceKey]['score'] += 30;
                $existing[$resourceKey]['source'] .= '+ai';
            } else {
                // Add new AI suggestion
                $existing[$resourceKey] = [
                    'name' => $aiSuggestion['name'],
                    'type' => $aiSuggestion['type'] ?? 'equipment',
                    'score' => 50, // AI suggestions get base score of 50
                    'source' => 'ai',
                ];
            }
        }

        return $existing;
    }

    /**
     * Get top suggestions with actual resource IDs from database.
     */
    private function getTopSuggestionsWithIds(array $suggestions): array
    {
        // Sort by score descending
        usort($suggestions, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Take top N suggestions
        $topSuggestions = array_slice($suggestions, 0, self::TOP_SUGGESTIONS);

        $result = [];

        foreach ($topSuggestions as $suggestion) {
            // Try to find existing resource with this name
            $resource = Resource::whereRaw('LOWER(name) = ?', [strtolower($suggestion['name'])])
                ->first();

            // Calculate confidence for this specific resource (0-100)
            $confidence = min(100, $suggestion['score']);

            $result[] = [
                'id' => $resource ? $resource->id : null,
                'name' => $suggestion['name'],
                'confidence' => round($confidence, 2),
            ];
        }

        return $result;
    }

    /**
     * Calculate text similarity based on common keywords.
     */
    private function calculateTextSimilarity(string $text1, string $text2): float
    {
        // Remove common words (stopwords)
        $stopwords = ['the', 'a', 'an', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by'];

        $words1 = array_diff(
            explode(' ', preg_replace('/[^a-z0-9\s]/', '', $text1)),
            $stopwords
        );

        $words2 = array_diff(
            explode(' ', preg_replace('/[^a-z0-9\s]/', '', $text2)),
            $stopwords
        );

        $words1 = array_filter($words1);
        $words2 = array_filter($words2);

        if (empty($words1) || empty($words2)) {
            return 0;
        }

        // Count common words
        $commonWords = array_intersect($words1, $words2);
        $commonCount = count($commonWords);

        // Calculate similarity as percentage of common words
        $similarity = $commonCount / max(count($words1), count($words2));

        return $similarity;
    }
}
