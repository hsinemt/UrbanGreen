<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'feedback';

    protected $fillable = [
        'event_id',
        'user_id',
        'parent_feedback_id',
        'comment',
        'rating',
        'status',
        'likes_count',
        'is_edited',
        'edited_at',
    ];

    protected $casts = [
        'is_edited' => 'boolean',
        'edited_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the event that this feedback belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user who posted this feedback.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent feedback (if this is a reply).
     */
    public function parent()
    {
        return $this->belongsTo(Feedback::class, 'parent_feedback_id');
    }

    /**
     * Get all replies to this feedback.
     */
    public function replies()
    {
        return $this->hasMany(Feedback::class, 'parent_feedback_id')
            ->where('status', 'active')
            ->latest();
    }

    // ==================== SCOPES ====================

    /**
     * Scope to get only top-level feedback (not replies).
     */
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_feedback_id');
    }

    /**
     * Scope to get only replies.
     */
    public function scopeReplies($query)
    {
        return $query->whereNotNull('parent_feedback_id');
    }

    /**
     * Scope to get only active feedback.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get feedback with rating.
     */
    public function scopeWithRating($query)
    {
        return $query->whereNotNull('rating');
    }

    /**
     * Scope to get most liked feedback.
     */
    public function scopeMostLiked($query)
    {
        return $query->orderBy('likes_count', 'desc');
    }

    // ==================== HELPER METHODS ====================

    /**
     * Check if this feedback is a reply.
     */
    public function isReply(): bool
    {
        return !is_null($this->parent_feedback_id);
    }

    /**
     * Check if this feedback is top-level (has no parent).
     */
    public function isTopLevel(): bool
    {
        return is_null($this->parent_feedback_id);
    }

    /**
     * Increment likes count.
     */
    public function incrementLikes()
    {
        $this->increment('likes_count');
        return $this;
    }

    /**
     * Decrement likes count.
     */
    public function decrementLikes()
    {
        if ($this->likes_count > 0) {
            $this->decrement('likes_count');
        }
        return $this;
    }

    /**
     * Mark feedback as edited.
     */
    public function markAsEdited()
    {
        $this->update([
            'is_edited' => true,
            'edited_at' => now(),
        ]);
    }

    /**
     * Get average rating for an event.
     */
    public static function getAverageRatingForEvent($eventId)
    {
        return self::where('event_id', $eventId)
            ->active()
            ->whereNotNull('rating')
            ->avg('rating');
    }

    /**
     * Get rating distribution for an event.
     */
    public static function getRatingDistributionForEvent($eventId)
    {
        $distribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $distribution[$i] = self::where('event_id', $eventId)
                ->active()
                ->where('rating', $i)
                ->count();
        }
        return $distribution;
    }

    // ==================== VALIDATION RULES ====================

    /**
     * Validation rules for creating feedback.
     */
    public static function validationRulesCreate(): array
    {
        return [
            'comment' => 'required|string|min:3|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
            'parent_feedback_id' => 'nullable|exists:feedback,id',
        ];
    }

    /**
     * Validation rules for updating feedback.
     */
    public static function validationRulesUpdate(): array
    {
        return [
            'comment' => 'required|string|min:3|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
        ];
    }
}
