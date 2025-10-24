<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'date',
        'location',
        'image',
        'budget',
        'project_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'budget' => 'decimal:2',
    ];

    /**
     * The activities that belong to the event.
     */
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'event_activity');
    }

    /**
     * The project that owns the event.
     */
    public function project()
    {
        return $this->belongsTo(Projet::class);
    }

    // Relation avec Wallets
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * Get all resources for this event.
     */
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * Get all feedback for this event.
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * Get the summary for this event.
     */
    public function summary()
    {
        return $this->hasOne(EventSummary::class);
    }

    /**
     * Get the total number of resources for this event.
     */
    public function getTotalResourcesAttribute()
    {
        return $this->resources()->count();
    }

    /**
     * Get the total quantity of all resources for this event.
     */
    public function getTotalQuantityAttribute()
    {
        return $this->resources()->sum('quantity');
    }

    /**
     * Get the average rating for this event.
     */
    public function getAverageRatingAttribute()
    {
        return Feedback::getAverageRatingForEvent($this->id);
    }

    /**
     * Get the total feedback count for this event.
     */
    public function getFeedbackCountAttribute()
    {
        return $this->feedback()->active()->count();
    }

    /**
     * Scope a query to only include events with resources.
     */
    public function scopeWithResources($query)
    {
        return $query->has('resources');
    }

    /**
     * Scope a query to only include upcoming events.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now());
    }

    /**
     * Scope a query to only include past events.
     */
    public function scopePast($query)
    {
        return $query->where('date', '<', now());
    }

    /**
     * Scope a query to include feedback count.
     */
    public function scopeWithFeedbackCount($query)
    {
        return $query->withCount(['feedback' => function ($query) {
            $query->where('status', 'active');
        }]);
    }
}
