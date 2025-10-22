<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plant extends Model
{
    protected $fillable = [
        'nom',
        'date_plantation',
        'date_croissance_prevue',
        'personne_plantation',
        'milieu_croissance',
        'green_space_id',
    ];

    protected $casts = [
        'date_plantation' => 'date',
        'date_croissance_prevue' => 'date',
    ];

    /**
     * Relation avec GreenSpace
     */
    public function greenSpace(): BelongsTo
    {
        return $this->belongsTo(GreenSpace::class);
    }
}
