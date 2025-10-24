<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventSummary;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CommentSummaryService
{
    private const MINIMUM_COMMENTS = 5;

    private const CACHE_DURATION = 1 * 60; // 24 hours in seconds

    private const OPENAI_MODEL = 'gpt-4o-mini'; // Cheapest model

    private const MAX_COMMENTS_TO_ANALYZE = 50; // Limit comments for faster processing

    private const API_TIMEOUT = 30; // 30 seconds timeout for OpenAI API

    /**
     * Generate or retrieve cached summary for an event.
     *
     * @throws \Exception
     */
    public function getSummary(Event $event): array
    {
        // Check if event has minimum required comments
        $commentCount = $this->getActiveCommentCount($event);

        if ($commentCount < self::MINIMUM_COMMENTS) {
            throw new \Exception('Need at least '.self::MINIMUM_COMMENTS.' comments to generate summary');
        }

        // Check if we have a recent summary (less than 24 hours old)
        $existingSummary = $event->summary;

        if ($existingSummary && $this->isSummaryFresh($existingSummary)) {
            Log::info('Returning cached summary', ['event_id' => $event->id]);

            return $this->formatSummaryResponse($existingSummary);
        }

        // Generate new summary
        Log::info('Generating new summary', ['event_id' => $event->id, 'comment_count' => $commentCount]);

        return $this->generateNewSummary($event);
    }

    /**
     * Get count of active top-level comments for an event.
     */
    private function getActiveCommentCount(Event $event): int
    {
        $count = $event->feedback()
            ->whereNull('parent_feedback_id')
            ->where('status', 'active')
            ->count();

        \Log::info('Counting comments for event '.$event->id.': '.$count);

        return $count;
    }

    /**
     * Check if summary is fresh (less than 24 hours old).
     */
    private function isSummaryFresh(EventSummary $summary): bool
    {
        // Compare in seconds for precision (works better for short durations like 1 minute)
        return $summary->generated_at->diffInSeconds(now()) < self::CACHE_DURATION;
    }

    /**
     * Generate a new summary by calling OpenAI API.
     *
     * @throws \Exception
     */
    private function generateNewSummary(Event $event): array
    {
        // Get active top-level comments (limit to most recent for faster processing)
        $comments = $event->feedback()
            ->whereNull('parent_feedback_id')
            ->where('status', 'active')
            ->with('user')
            ->latest()
            ->take(self::MAX_COMMENTS_TO_ANALYZE)
            ->get();

        \Log::info('Fetched comments for AI summary', [
            'event_id' => $event->id,
            'comments_count' => $comments->count(),
        ]);

        // Prepare comments text for OpenAI with UTF-8 cleaning
        $commentsText = $comments->map(function ($feedback) {
            $userName = $feedback->user ? $feedback->user->name : 'Anonymous';
            $rating = $feedback->rating ? " (Rating: {$feedback->rating}/5)" : '';
            $cleanComment = $this->cleanText($feedback->comment);

            return "- {$userName}{$rating}: {$cleanComment}";
        })->join("\n");

        // Call OpenAI API
        $analysisData = $this->callOpenAI($commentsText);

        // Save to database
        $summary = $this->saveSummary($event, $analysisData, $comments->count());

        return $this->formatSummaryResponse($summary);
    }

    /**
     * Clean and sanitize text to ensure proper UTF-8 encoding.
     * Multi-layered aggressive approach to handle deeply malformed UTF-8.
     */
    private function cleanText(string $text): string
    {
        if (empty($text)) {
            return '';
        }

        // Layer 1: Remove null bytes and common problematic characters
        $text = str_replace(["\0", "\x00", "\xEF\xBB\xBF"], '', $text);

        // Layer 2: Use iconv for aggressive UTF-8 conversion with IGNORE and TRANSLIT
        // This strips out any characters that can't be converted to UTF-8
        $text = @iconv('UTF-8', 'UTF-8//IGNORE//TRANSLIT', $text);

        if ($text === false) {
            // If iconv fails, try mb_convert_encoding as fallback
            $text = @mb_convert_encoding($text, 'UTF-8', 'UTF-8');
        }

        // Layer 3: Remove all control characters except newlines, carriage returns, and tabs
        $text = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u', '', $text);

        // Layer 4: Remove any remaining invalid UTF-8 sequences
        if (! mb_check_encoding($text, 'UTF-8')) {
            // Force UTF-8 by detecting encoding and converting
            $encoding = mb_detect_encoding($text, ['UTF-8', 'ISO-8859-1', 'Windows-1252', 'ASCII'], true);
            if ($encoding && $encoding !== 'UTF-8') {
                $text = mb_convert_encoding($text, 'UTF-8', $encoding);
            } else {
                // Last resort: keep only ASCII printable characters and basic punctuation
                $text = preg_replace('/[^\x20-\x7E\n\r\t]/u', '', $text);
            }
        }

        // Layer 5: Validate that the text can be JSON encoded (final check)
        $jsonTest = json_encode($text);
        if ($jsonTest === false) {
            // If still failing, aggressively strip to ASCII only
            $text = preg_replace('/[^\x20-\x7E\n\r\t]/', '', $text);
        }

        // Layer 6: Normalize whitespace
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);

        return $text;
    }

    /**
     * Call OpenAI API to analyze comments.
     *
     * @throws \Exception
     */
    private function callOpenAI(string $commentsText): array
    {
        $apiKey = config('services.openai.api_key') ?: env('OPENAI_API_KEY');

        if (! $apiKey) {
            throw new \Exception('OpenAI API key not configured');
        }

        // Build the prompt (concise for faster processing)
        $prompt = "Analyze these event comments and return JSON with: summary (2-3 sentences), sentiment_positive_percent, sentiment_neutral_percent, sentiment_negative_percent, praised (top 3 array), suggestions (top 3 array).\n\nComments:\n{$commentsText}";

        // Clean the entire prompt to ensure proper UTF-8 encoding
        $cleanPrompt = $this->cleanText($prompt);

        // System message should also be cleaned
        $systemMessage = $this->cleanText('You are an AI assistant that analyzes feedback for environmental events. Always respond with valid JSON only, no markdown formatting.');

        // Prepare the payload
        $payload = [
            'model' => self::OPENAI_MODEL,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemMessage,
                ],
                [
                    'role' => 'user',
                    'content' => $cleanPrompt,
                ],
            ],
            'temperature' => 0.7,
            'max_tokens' => 800,
        ];

        // Validate payload can be JSON encoded before sending (early detection of UTF-8 issues)
        $jsonTest = json_encode($payload);
        if ($jsonTest === false) {
            $error = json_last_error_msg();
            Log::error('Payload JSON encoding failed - UTF-8 issue detected', [
                'error' => $error,
                'system_message_length' => strlen($systemMessage),
                'prompt_length' => strlen($cleanPrompt),
                'system_valid_utf8' => mb_check_encoding($systemMessage, 'UTF-8'),
                'prompt_valid_utf8' => mb_check_encoding($cleanPrompt, 'UTF-8'),
            ]);
            throw new \Exception("Unable to encode request payload: {$error}. Please contact support.");
        }

        Log::info('OpenAI API request prepared successfully', [
            'payload_size' => strlen($jsonTest),
            'messages_count' => count($payload['messages']),
        ]);

        try {
            $response = Http::withOptions([
                'verify' => false,
            ])->withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json; charset=utf-8',
            ])->timeout(self::API_TIMEOUT)->post('https://api.openai.com/v1/chat/completions', $payload);

            if (! $response->successful()) {
                Log::error('OpenAI API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                throw new \Exception('Failed to generate summary: '.$response->body());
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

            $analysisData = json_decode($content, true);

            if (! $analysisData) {
                Log::error('Failed to parse OpenAI response', ['content' => $content]);
                throw new \Exception('Failed to parse OpenAI response');
            }

            return $analysisData;

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('OpenAI API connection timeout', ['error' => $e->getMessage()]);
            throw new \Exception('Request timed out. The AI service is taking longer than expected. Please try again.');
        } catch (\Exception $e) {
            Log::error('OpenAI API call failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Save summary to database.
     */
    private function saveSummary(Event $event, array $analysisData, int $commentCount): EventSummary
    {
        // Build summary text with sections - apply UTF-8 cleaning
        $summaryText = $this->cleanText($analysisData['summary'] ?? 'No summary available');

        $praised = $analysisData['praised'] ?? [];
        if (! empty($praised)) {
            $summaryText .= "\n\nWhat Worked Well:\n";
            foreach ($praised as $item) {
                $cleanItem = $this->cleanText($item);
                $summaryText .= "• {$cleanItem}\n";
            }
        }

        $suggestions = $analysisData['suggestions'] ?? [];
        if (! empty($suggestions)) {
            $summaryText .= "\nSuggestions for Improvement:\n";
            foreach ($suggestions as $item) {
                $cleanItem = $this->cleanText($item);
                $summaryText .= "• {$cleanItem}\n";
            }
        }

        // Validate before saving
        if (json_encode($summaryText) === false) {
            Log::error('Summary text has UTF-8 issues', [
                'error' => json_last_error_msg(),
                'summary_length' => strlen($summaryText),
            ]);
            // Force clean everything
            $summaryText = mb_convert_encoding($summaryText, 'UTF-8', 'UTF-8');
        }

        Log::info('Saving summary', [
            'event_id' => $event->id,
            'summary_length' => strlen($summaryText),
            'sentiment_positive' => $analysisData['sentiment_positive_percent'] ?? 0,
            'sentiment_neutral' => $analysisData['sentiment_neutral_percent'] ?? 0,
            'sentiment_negative' => $analysisData['sentiment_negative_percent'] ?? 0,
        ]);

        return EventSummary::updateOrCreate(
            ['event_id' => $event->id],
            [
                'summary_text' => $summaryText,
                'sentiment_positive_percent' => $analysisData['sentiment_positive_percent'] ?? 0,
                'sentiment_neutral_percent' => $analysisData['sentiment_neutral_percent'] ?? 0,
                'sentiment_negative_percent' => $analysisData['sentiment_negative_percent'] ?? 0,
                'total_comments_analyzed' => $commentCount,
                'generated_at' => now(),
            ]
        );
    }

    /**
     * Format summary for API response.
     */
    private function formatSummaryResponse(EventSummary $summary): array
    {
        // Parse the summary text to extract sections
        $parts = explode("\n\n", $summary->summary_text);
        $mainSummary = $parts[0] ?? '';

        $praised = [];
        $suggestions = [];

        foreach ($parts as $part) {
            if (str_contains($part, 'What Worked Well')) {
                $lines = explode("\n", $part);
                foreach ($lines as $line) {
                    if (str_starts_with($line, '•')) {
                        $praised[] = trim(substr($line, 1));
                    }
                }
            } elseif (str_contains($part, 'Suggestions for Improvement')) {
                $lines = explode("\n", $part);
                foreach ($lines as $line) {
                    if (str_starts_with($line, '•')) {
                        $suggestions[] = trim(substr($line, 1));
                    }
                }
            }
        }

        return [
            'summary' => $mainSummary,
            'sentiment' => [
                'positive' => (float) $summary->sentiment_positive_percent,
                'neutral' => (float) $summary->sentiment_neutral_percent,
                'negative' => (float) $summary->sentiment_negative_percent,
            ],
            'praised' => $praised,
            'suggestions' => $suggestions,
            'total_comments_analyzed' => $summary->total_comments_analyzed,
            'generated_at' => $summary->generated_at,
            'hours_ago' => $summary->generated_at->diffInHours(now()),
        ];
    }
}
