<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'quantity',
        'description',
        'supplier_id',
        'event_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the supplier (user) that owns this resource.
     */
    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    /**
     * Get the event this resource belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Scope a query to only include resources for a specific event.
     */
    public function scopeForEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    /**
     * Scope a query to only include resources from a specific supplier.
     */
    public function scopeFromSupplier($query, $supplierId)
    {
        return $query->where('supplier_id', $supplierId);
    }

    /**
     * Get validation rules for resource.
     */
    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get validation messages for resource.
     */
    public static function validationMessages()
    {
        return [
            'name.required' => 'Resource name is required',
            'name.max' => 'Resource name cannot exceed 255 characters',
            'type.required' => 'Resource type is required',
            'type.max' => 'Resource type cannot exceed 100 characters',
            'quantity.required' => 'Quantity is required',
            'quantity.integer' => 'Quantity must be a number',
            'quantity.min' => 'Quantity must be at least 1',
            'description.max' => 'Description cannot exceed 1000 characters',
        ];
    }

    /**
     * Get the supplier's display name.
     */
    public function getSupplierNameAttribute()
    {
        if (!$this->supplier) {
            return 'Unknown Supplier';
        }

        return $this->supplier->display_name ?? $this->supplier->name ?? 'N/A';
    }
}
