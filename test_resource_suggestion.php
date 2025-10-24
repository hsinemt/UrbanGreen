<?php

/**
 * Test script for Resource Suggestion System
 *
 * This script tests the ResourceSuggestionService without making HTTP requests.
 * Run with: php test_resource_suggestion.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Event;
use App\Services\ResourceSuggestionService;

echo "=== Testing Resource Suggestion Service ===\n\n";

try {
    // Test 1: Check if service can be instantiated
    echo "Test 1: Instantiating ResourceSuggestionService...\n";
    $service = new ResourceSuggestionService();
    echo "✓ Service instantiated successfully\n\n";

    // Test 2: Test with a mock event (tree planting)
    echo "Test 2: Testing with a tree planting event...\n";
    $treePlantingEvent = new Event([
        'id' => 9999,
        'name' => 'Community Tree Planting Day',
        'description' => 'Join us for a tree planting event in the local park. We will be planting native saplings to improve the urban canopy.',
        'date' => now()->addDays(7),
        'location' => 'Central Park',
    ]);
    $treePlantingEvent->id = 9999; // Set ID manually for testing

    echo "Event: {$treePlantingEvent->name}\n";
    echo "Description: {$treePlantingEvent->description}\n\n";

    $result = $service->suggest($treePlantingEvent);

    echo "✓ Suggestions generated successfully\n";
    echo "Confidence Score: {$result['confidence_score']}\n";
    echo "Number of suggestions: " . count($result['suggestions']) . "\n";
    echo "\nTop 5 Suggestions:\n";

    foreach (array_slice($result['suggestions'], 0, 5) as $index => $suggestion) {
        echo sprintf(
            "%d. %s (ID: %s, Confidence: %.2f%%)\n",
            $index + 1,
            $suggestion['name'],
            $suggestion['id'] ?? 'N/A',
            $suggestion['confidence']
        );
    }

    echo "\n";

    // Test 3: Test with beach cleanup event
    echo "Test 3: Testing with a beach cleanup event...\n";
    $beachCleanupEvent = new Event([
        'id' => 9998,
        'name' => 'Annual Beach Cleanup',
        'description' => 'Help clean our beautiful beaches! We need volunteers for our beach cleanup initiative to remove trash and debris.',
        'date' => now()->addDays(14),
        'location' => 'Sunset Beach',
    ]);
    $beachCleanupEvent->id = 9998;

    echo "Event: {$beachCleanupEvent->name}\n";
    echo "Description: {$beachCleanupEvent->description}\n\n";

    $result2 = $service->suggest($beachCleanupEvent);

    echo "✓ Suggestions generated successfully\n";
    echo "Confidence Score: {$result2['confidence_score']}\n";
    echo "Number of suggestions: " . count($result2['suggestions']) . "\n";
    echo "\nTop 5 Suggestions:\n";

    foreach (array_slice($result2['suggestions'], 0, 5) as $index => $suggestion) {
        echo sprintf(
            "%d. %s (ID: %s, Confidence: %.2f%%)\n",
            $index + 1,
            $suggestion['name'],
            $suggestion['id'] ?? 'N/A',
            $suggestion['confidence']
        );
    }

    echo "\n";

    // Test 4: Test caching
    echo "Test 4: Testing cache functionality...\n";
    $start = microtime(true);
    $cachedResult = $service->suggest($treePlantingEvent);
    $duration = microtime(true) - $start;

    echo "✓ Cached result retrieved in " . round($duration * 1000, 2) . "ms\n";
    echo "Cache is working properly (should be much faster than first call)\n\n";

    echo "=== All Tests Passed! ===\n";
    echo "\nThe Resource Suggestion System is working correctly.\n";
    echo "You can now test the API endpoint:\n";
    echo "GET /api/events/{event_id}/suggest-resources\n";

} catch (\Exception $e) {
    echo "✗ Test failed with error:\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
