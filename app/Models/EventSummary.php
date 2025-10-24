<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSummary extends Model
{
    protected $table = 'event_summaries';

    protected $fillable = [
        'event_id',
        'summary_text',
        'sentiment_positive_percent',
        'sentiment_neutral_percent',
        'sentiment_negative_percent',
        'total_comments_analyzed',
        'generated_at',
    ];

    protected $casts = [
        'sentiment_positive_percent' => 'decimal:2',
        'sentiment_neutral_percent' => 'decimal:2',
        'sentiment_negative_percent' => 'decimal:2',
        'total_comments_analyzed' => 'integer',
        'generated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the event that owns the summary.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
