<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectStatusChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'projet_id',
        'from_status',
        'to_status',
        'user_id',
        'note',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}


