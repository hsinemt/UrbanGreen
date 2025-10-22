<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'organization_name',
        'partnership_type',
        'industry_sector',
        'partnership_start_date',
        'contribution_type',
        'contact_person',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'partnership_start_date' => 'date',
        ];
    }

    /**
     * Get the user that owns this partner profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get validation rules for partner
     */
    public static function validationRules(): array
    {
        return [
            'organization_name' => 'required|string|max:255',
            'partnership_type' => 'nullable|string|max:100',
            'industry_sector' => 'nullable|string|max:100',
            'partnership_start_date' => 'nullable|date',
            'contribution_type' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
        ];
    }
}
