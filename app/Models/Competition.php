<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'partner_id',
        'projet_id',
        'reward',
        'description',
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function project()
    {
        return $this->belongsTo(Projet::class, 'projet_id');
    }

    public function associations()
    {
        return $this->belongsToMany(User::class, 'competition_association', 'competition_id', 'association_id');
    }
}
