<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
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
        'registration_number',
        'mission_statement',
        'founded_year',
        'website',
        'number_of_members',
        'organization_type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'founded_year' => 'integer',
            'number_of_members' => 'integer',
        ];
    }

    /**
     * Get the user that owns this association profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get validation rules for association
     */
    public static function validationRules(): array
    {
        return [
            'organization_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:100',
            'mission_statement' => 'nullable|string|max:1000',
            'founded_year' => 'nullable|integer|min:1800|max:'.date('Y'),
            'website' => 'nullable|url|max:255',
            'number_of_members' => 'nullable|integer|min:0',
            'organization_type' => 'nullable|string|max:100',
        ];
    }
}
