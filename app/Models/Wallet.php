<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'donation_count',
        'total_amount',
        'target_amount',
        'event_id'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'target_amount' => 'decimal:2',
        'donation_count' => 'integer'
    ];

    // Relation avec Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relation avec Donations
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // Méthode pour calculer le pourcentage de progression
    public function getProgressPercentageAttribute()
    {
        if ($this->target_amount == 0) {
            return 0;
        }
        return round(($this->total_amount / $this->target_amount) * 100, 2);
    }

    // Méthode pour vérifier si l'objectif est atteint
    public function isTargetReached()
    {
        return $this->total_amount >= $this->target_amount;
    }
}
