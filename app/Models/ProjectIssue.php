<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'projet_id',
        'title',
        'description',
        'severity',
        'status',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
