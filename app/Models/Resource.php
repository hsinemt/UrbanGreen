<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resources';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'quantity'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Validation rules for the resources.
     *
     * @return array
     */
    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ];
    }

    /**
     * Validation messages.
     *
     * @return array
     */
    public static function validationMessages()
    {
        return [
            'name.required' => 'The resources name is required.',
            'name.max' => 'The resources name cannot exceed 255 characters.',
            'type.required' => 'The resources type is required.',
            'type.max' => 'The resources type cannot exceed 255 characters.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'The quantity must be a number.',
            'quantity.min' => 'The quantity cannot be negative.',
        ];
    }
}
