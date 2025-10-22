<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'business_type',
        'product_catalog',
        'delivery_options',
        'payment_terms',
        'rating',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rating' => 'decimal:2',
        ];
    }

    /**
     * Get the user that owns this supplier profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get validation rules for supplier
     */
    public static function validationRules(): array
    {
        return [
            'company_name' => 'required|string|max:255',
            'business_type' => 'nullable|string|max:100',
            'product_catalog' => 'nullable|string|max:2000',
            'delivery_options' => 'nullable|string|max:500',
            'payment_terms' => 'nullable|string|max:500',
            'rating' => 'nullable|numeric|min:0|max:5',
        ];
    }
}
