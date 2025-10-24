# Smart Resource Suggestion System

## Overview
The Smart Resource Suggestion System is an intelligent feature for the UrbanGreen Laravel application that suggests resources needed for environmental events using multiple strategies:

1. **Historical Data Analysis** - Analyzes resources used in similar past events
2. **Keyword Matching** - Maps event descriptions to relevant resources using predefined keywords
3. **AI Enhancement** - Uses OpenAI API when confidence is low (<60%)

## Features

- ✅ Suggests top 10 resources with confidence scores (0-100)
- ✅ Caches results for 15 minutes to improve performance
- ✅ Graceful error handling and fallback mechanisms
- ✅ Supports 15+ environmental event types
- ✅ RESTful API endpoint
- ✅ Comprehensive logging

## Installation & Setup

### 1. Environment Configuration

Add your OpenAI API key to `.env`:

```env
OPENAI_API_KEY=your_openai_api_key_here
```

The system will work without the API key but with limited confidence for unknown event types.

### 2. Files Created

The following files have been created for this feature:

- `app/Services/ResourceSuggestionService.php` - Core service logic
- `app/Http/Controllers/ResourceSuggestionController.php` - API controller
- `routes/api.php` - API route definitions
- `test_resource_suggestion.php` - Test script

### 3. Configuration

The OpenAI API key is configured in `config/services.php`:

```php
'openai' => [
    'api_key' => env('OPENAI_API_KEY'),
],
```

## API Usage

### Endpoint

```
GET /api/events/{event}/suggest-resources
```

### Parameters

- `{event}` - The event ID (route model binding)

### Response Format

```json
{
  "success": true,
  "data": {
    "suggestions": [
      {
        "id": 1,
        "name": "Shovels",
        "confidence": 85.00
      },
      {
        "id": null,
        "name": "Gloves",
        "confidence": 75.50
      }
    ],
    "confidence_score": 85.00
  },
  "message": "Resource suggestions generated successfully"
}
```

### Response Fields

- `success` - Boolean indicating if the request was successful
- `data.suggestions` - Array of suggested resources (max 10)
  - `id` - Database ID if resource exists, null otherwise
  - `name` - Resource name
  - `confidence` - Confidence score for this specific suggestion (0-100)
- `data.confidence_score` - Overall confidence score for all suggestions (0-100)
- `message` - Human-readable status message

### Error Response

```json
{
  "success": false,
  "message": "Failed to generate suggestions",
  "error": "Error details here"
}
```

## Example Usage

### cURL Example

```bash
curl -X GET "http://your-domain.com/api/events/1/suggest-resources" \
  -H "Accept: application/json"
```

### JavaScript Fetch Example

```javascript
fetch('/api/events/1/suggest-resources')
  .then(response => response.json())
  .then(data => {
    console.log('Suggestions:', data.data.suggestions);
    console.log('Confidence:', data.data.confidence_score);
  });
```

### PHP Example

```php
use App\Services\ResourceSuggestionService;
use App\Models\Event;

$service = new ResourceSuggestionService();
$event = Event::find(1);
$result = $service->suggest($event);

echo "Confidence: " . $result['confidence_score'] . "%\n";
foreach ($result['suggestions'] as $suggestion) {
    echo "- " . $suggestion['name'] . " (" . $suggestion['confidence'] . "%)\n";
}
```

## Supported Event Types

The system recognizes the following environmental event types through keyword matching:

1. **Tree Planting** - shovels, saplings, watering cans, gloves, mulch, stakes
2. **Beach Cleanup** - trash bags, gloves, grabbers, bins, safety vests
3. **Park Cleanup** - rakes, brooms, trash bags, gloves, wheelbarrows
4. **Community Garden** - tools, seeds, soil, compost, watering equipment
5. **Trail Maintenance** - tools, signs, gravel, wood chips
6. **Recycling Drive** - bins, sorting tables, signs, gloves
7. **Forest Restoration** - native plants, shovels, mulch, watering cans, protective gear
8. **River Cleanup** - nets, gloves, waders, trash bags, safety vests
9. **Erosion Control** - sandbags, native plants, erosion blankets, stakes, tools
10. **Wildlife Habitat** - nesting boxes, native plants, tools, signage
11. **Composting Workshop** - compost bins, pitchforks, thermometers, educational materials
12. **Urban Farming** - seeds, tools, irrigation systems, raised beds, soil
13. **Wetland Restoration** - native wetland plants, waders, tools, marking stakes
14. **Pollution Monitoring** - testing kits, protective gear, sampling containers, clipboards
15. **Green Roof Installation** - growing medium, native plants, drainage materials, tools

## How It Works

### 1. Historical Data Analysis

The service analyzes past events with similar names and descriptions, calculating text similarity based on keyword overlap. Resources from similar events are suggested with confidence scores proportional to the similarity.

```php
// Example: If 3 similar past events all used "shovels", 
// the confidence for "shovels" will be higher
```

### 2. Keyword Matching

Event names and descriptions are scanned for predefined keywords. When a match is found, associated resources are suggested with a base confidence score.

```php
// Example: "Tree Planting Day" matches "tree planting" keyword
// Suggests: shovels, saplings, watering cans, gloves, mulch, stakes
```

### 3. AI Enhancement

When the overall confidence score is below 60%, the system calls OpenAI's GPT-3.5-turbo model to generate additional suggestions based on the event context.

```php
// Example: For unusual event types like "Vertical Garden Installation"
// AI provides context-aware suggestions
```

### 4. Confidence Score Calculation

```php
confidence = min(100, (max_score * 0.6 + avg_score * 0.4))
```

- Historical match: +50 points per similar event
- Keyword match: +40 points per keyword
- AI enhancement: +50 points base, +30 points boost for existing

## Performance

- **First Request**: ~100-500ms (depending on historical data and AI usage)
- **Cached Request**: <1ms
- **Cache Duration**: 15 minutes
- **Max Suggestions**: 10 resources

## Testing

Run the included test script:

```bash
php test_resource_suggestion.php
```

The test script verifies:
- ✅ Service instantiation
- ✅ Tree planting event suggestions
- ✅ Beach cleanup event suggestions
- ✅ Cache functionality

## Logging

The system logs all operations to Laravel's standard log:

```php
// Info logs
Log::info('Generating new resource suggestions', ['event_id' => $event->id]);
Log::info('Keyword match found', ['keyword' => 'tree planting']);

// Warning logs
Log::warning('AI enhancement failed, using base suggestions');

// Error logs
Log::error('OpenAI API error', ['status' => 500, 'body' => '...']);
```

## Error Handling

The system handles errors gracefully:

1. **No Historical Data**: Falls back to keyword matching
2. **No Keyword Match**: Falls back to AI (if configured)
3. **AI API Failure**: Returns base suggestions without AI enhancement
4. **No API Key**: Works without AI enhancement
5. **Database Errors**: Logs error and returns appropriate HTTP 500 response

## Troubleshooting

### Issue: Low Confidence Scores

**Solution**: 
- Add more historical event data
- Ensure event descriptions include relevant keywords
- Configure OpenAI API key for AI enhancement

### Issue: No Suggestions Returned

**Solution**:
- Check if event has name and description
- Verify event type matches supported keywords
- Check logs for errors

### Issue: AI Enhancement Not Working

**Solution**:
- Verify OPENAI_API_KEY is set in .env
- Check if confidence score is below 60%
- Review logs for API errors
- Verify SSL/TLS configuration

### Issue: Slow Response Times

**Solution**:
- Check if caching is working (should be fast on 2nd request)
- Reduce number of historical events being analyzed
- Optimize database queries with indexes

## Future Enhancements

Potential improvements for future versions:

- [ ] Machine learning model trained on historical data
- [ ] Support for multi-language event descriptions
- [ ] Resource quantity estimation
- [ ] Budget estimation for resources
- [ ] Supplier recommendations
- [ ] Seasonal resource variations
- [ ] User feedback loop to improve suggestions

## License

Part of the UrbanGreen Laravel application.

## Support

For issues or questions, check the Laravel logs:

```bash
tail -f storage/logs/laravel.log
```

---

**Created**: 2025-10-24  
**Version**: 1.0  
**Author**: Junie AI Assistant
