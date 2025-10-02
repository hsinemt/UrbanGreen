<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

