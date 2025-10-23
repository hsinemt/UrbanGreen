<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'location',
        'description',
        'image',
        'budget',
        'project_id',
    ];

    protected $casts = [
        'date' => 'date',
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
}