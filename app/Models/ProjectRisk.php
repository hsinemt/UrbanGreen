<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectRisk extends Model
{
    use HasFactory;

    protected $fillable = [
        'projet_id',
        'title',
        'description',
        'probability',
        'impact',
        'mitigation',
        'status',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}


