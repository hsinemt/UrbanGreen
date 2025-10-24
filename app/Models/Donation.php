<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'currency',
        'date',
        'payment_method',
        'wallet_id',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    // Relations possibles avec d'autres modèles
    // Par exemple avec User si vous voulez associer les donations aux utilisateurs
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // Relation avec Wallet
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
