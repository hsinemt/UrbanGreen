<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'time_to_finish',
        'num_persons',
    ];

    protected $casts = [
        'time_to_finish' => 'integer',
        'num_persons' => 'integer',
    ];

    // Status constants for better code maintainability
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';

    // Get all available statuses
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
        ];
    }

    // Check if activity is completed
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    // Check if activity is in progress
    public function isInProgress()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    // Check if activity is pending
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    // Get progress percentage based on status
    public function getProgressPercentage()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 0;
            case self::STATUS_IN_PROGRESS:
                return 50;
            case self::STATUS_COMPLETED:
                return 100;
            default:
                return 0;
        }
    }

    // Get formatted status
    public function getFormattedStatus()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    // Scope for filtering by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope for pending activities
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    // Scope for in progress activities
    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    // Scope for completed activities
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * The events that belong to the activity.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_activity');
    }
}
