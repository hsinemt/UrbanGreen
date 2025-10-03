<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'progress_percentage',
        'budget',
    ];

    /**
     * Attribute type casting.
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'progress_percentage' => 'integer',
        'budget' => 'decimal:2',
    ];

    /**
     * Supported project status values.
     */
    public const STATUS_PLANNED = 'planned';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    /**
     * Get all allowed status values.
     */
    public static function allowedStatuses(): array
    {
        return [
            self::STATUS_PLANNED,
            self::STATUS_IN_PROGRESS,
            self::STATUS_COMPLETED,
            self::STATUS_CANCELLED,
        ];
    }

    // Relations
//    public function risks()
//    {
//        return $this->hasMany(\App\Models\ProjectRisk::class, 'projet_id');
//    }

//    public function issues()
//    {
//        return $this->hasMany(\App\Models\ProjectIssue::class, 'projet_id');
//    }

    public function statusChanges()
    {
        return $this->hasMany(\App\Models\ProjectStatusChange::class, 'projet_id');
    }
}
