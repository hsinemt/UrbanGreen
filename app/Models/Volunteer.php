<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'skills',
        'availability',
        'hours_contributed',
        'joined_date',
        'volunteer_id_number',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'joined_date' => 'date',
            'hours_contributed' => 'integer',
        ];
    }

    /**
     * Get the user that owns this volunteer profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get volunteer's age
     */
    public function getAgeAttribute(): ?int
    {
        if (!$this->date_of_birth) {
            return null;
        }

        return $this->date_of_birth->age;
    }

    /**
     * Get parsed skills array
     */
    public function getSkillsArrayAttribute(): array
    {
        if (!$this->skills) {
            return [];
        }

        // If skills is JSON
        if (is_array(json_decode($this->skills, true))) {
            return json_decode($this->skills, true);
        }

        // If skills is comma-separated
        return array_map('trim', explode(',', $this->skills));
    }

    /**
     * Get validation rules for volunteer
     */
    public static function validationRules(): array
    {
        return [
            'date_of_birth' => 'nullable|date|before:today',
            'skills' => 'nullable|string|max:1000',
            'availability' => 'nullable|string|max:255',
            'hours_contributed' => 'nullable|integer|min:0',
            'joined_date' => 'nullable|date',
            'volunteer_id_number' => 'nullable|string|max:50',
        ];
    }
}
