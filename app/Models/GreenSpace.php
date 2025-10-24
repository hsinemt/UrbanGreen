<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GreenSpace extends Model
{
    protected $fillable = [
        'name',
        'location',
        'surface',
        'availability',
        'description',
        'type',
    ];

    /**
     * Relation avec les plantes
     */
    public function plants(): HasMany
    {
        return $this->hasMany(Plant::class);
    }
}
