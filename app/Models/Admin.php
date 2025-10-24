<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'admin_level',
        'permissions',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'permissions' => 'array',
        ];
    }

    /**
     * Get the user that owns this admin profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if admin has a specific permission
     */
    public function hasPermission(string $permission): bool
    {
        if (! $this->permissions) {
            return false;
        }

        return in_array($permission, $this->permissions);
    }

    /**
     * Get validation rules for admin
     */
    public static function validationRules(): array
    {
        return [
            'admin_level' => 'nullable|string|in:standard,super,master',
            'permissions' => 'nullable|array',
        ];
    }
}
