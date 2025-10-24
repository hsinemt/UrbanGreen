<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\ResourceSuggestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 * Controller for handling resource suggestion requests
 *
 * Provides AI-powered and data-driven suggestions for resources
 * needed for environmental events
 */
class ResourceSuggestionController extends Controller
{
    /**
     * The resource suggestion service instance.
     *
     * @var ResourceSuggestionService
     */
    private $suggestionService;

    /**
     * Create a new controller instance.
     *
     * @param ResourceSuggestionService $suggestionService
     */
    public function __construct(ResourceSuggestionService $suggestionService)
    {
        $this->suggestionService = $suggestionService;
    }

    /**
     * Get resource suggestions for a specific event.
     *
     * This endpoint uses multiple strategies to suggest resources:
     * 1. Historical data from similar past events
     * 2. Keyword matching based on event type
     * 3. AI enhancement when confidence is low
     *
     * Results are cached for 15 minutes to improve performance.
     *
     * @param Event $event The event to get suggestions for
     * @return JsonResponse
     *
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "suggestions": [
     *       {"id": 1, "name": "Shovels", "confidence": 85},
     *       {"id": 2, "name": "Gloves", "confidence": 75}
     *     ],
     *     "confidence_score": 85
     *   },
     *   "message": "Resource suggestions generated successfully"
     * }
     *
     * @response 404 {
     *   "success": false,
     *   "message": "Event not found"
     * }
     *
     * @response 500 {
     *   "success": false,
     *   "message": "Failed to generate suggestions",
     *   "error": "Error details..."
     * }
     */
    public function suggest(Event $event): JsonResponse
    {
        try {
            Log::info('Resource suggestion request received', [
                'event_id' => $event->id,
                'event_name' => $event->name
            ]);

            // Generate suggestions using the service
            $result = $this->suggestionService->suggest($event);

            Log::info('Resource suggestions generated successfully', [
                'event_id' => $event->id,
                'suggestions_count' => count($result['suggestions']),
                'confidence_score' => $result['confidence_score']
            ]);

            return response()->json([
                'success' => true,
                'data' => $result,
                'message' => 'Resource suggestions generated successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to generate resource suggestions', [
                'event_id' => $event->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to generate suggestions',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
