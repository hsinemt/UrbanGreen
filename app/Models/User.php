<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, Notifiable, MustVerifyEmailTrait;

    // Role constants
    public const ROLE_ASSOCIATION = 'association';
    public const ROLE_PARTNER = 'partner';
    public const ROLE_VOLUNTEER = 'volunteer';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_SUPPLIER = 'supplier';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'avatar',
        'bio',
        'phone',
        'address',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name', 'avatar_url', 'display_name'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function allowedRoles(): array
    {
        return [
            self::ROLE_ASSOCIATION,
            self::ROLE_PARTNER,
            self::ROLE_VOLUNTEER,
        ];
    }

    public function isAssociation(): bool
    {
        return $this->role === self::ROLE_ASSOCIATION;
    }

    public function isPartner(): bool
    {
        return $this->role === self::ROLE_PARTNER;
    }

    public function isVolunteer(): bool
    {
        return $this->role === self::ROLE_VOLUNTEER;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

    public static function allowedRoles(): array
    {
        return [
            self::ROLE_ASSOCIATION,
            self::ROLE_PARTNER,
            self::ROLE_VOLUNTEER,
        ];
    }

    public function isAssociation(): bool
    {
        return $this->role === self::ROLE_ASSOCIATION;
    }

    public function isPartner(): bool
    {
        return $this->role === self::ROLE_PARTNER;
    }

    public function isVolunteer(): bool
    {
        return $this->role === self::ROLE_VOLUNTEER;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

    /**
     * Get all allowed roles
     */
    public static function allowedRoles(): array
    {
        return [
            self::ROLE_ASSOCIATION,
            self::ROLE_PARTNER,
            self::ROLE_VOLUNTEER,
            self::ROLE_ADMIN,
            self::ROLE_SUPPLIER,
        ];
    }

    // ==================== ROLE CHECK METHODS ====================

    /**
     * Check if user is an association
     */
    public function isAssociation(): bool
    {
        return $this->role === self::ROLE_ASSOCIATION;
    }

    /**
     * Check if user is a partner
     */
    public function isPartner(): bool
    {
        return $this->role === self::ROLE_PARTNER;
    }

    /**
     * Check if user is a volunteer
     */
    public function isVolunteer(): bool
    {
        return $this->role === self::ROLE_VOLUNTEER;
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if user is a supplier
     */
    public function isSupplier(): bool
    {
        return $this->role === self::ROLE_SUPPLIER;
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get the association profile
     */
    public function association()
    {
        return $this->hasOne(Association::class);
    }

    /**
     * Get the supplier profile
     */
    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    /**
     * Get the partner profile
     */
    public function partner()
    {
        return $this->hasOne(Partner::class);
    }

    /**
     * Get the volunteer profile
     */
    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

    /**
     * Get the admin profile
     */
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    /**
     * Get the role-specific profile dynamically
     */
    public function roleProfile()
    {
        return match($this->role) {
            self::ROLE_ASSOCIATION => $this->association,
            self::ROLE_SUPPLIER => $this->supplier,
            self::ROLE_PARTNER => $this->partner,
            self::ROLE_VOLUNTEER => $this->volunteer,
            self::ROLE_ADMIN => $this->admin,
            default => null,
        };
    }

    /**
     * Get user's projects
     */
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

    /**
     * Get user's feedback
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    // ==================== ATTRIBUTES ====================

    /**
     * Get the user's full name
     */
    public function getNameAttribute(): string
    {
        return (string) ($this->full_name ?? '');
    }
    public function joinedCompetitions()
{
    return $this->belongsToMany(Competition::class, 'competition_association', 'association_id', 'competition_id');
}

    /**
     * Get display name based on role
     * For organizations, show organization/company name
     * For individuals, show full name
     */
    /**
     * Get the user's display name based on their role.
     */
    public function getDisplayNameAttribute()
    {
        if ($this->role === 'supplier' && $this->supplier) {
            return $this->supplier->company_name ?? ($this->full_name ?? '');
        }

        if ($this->role === 'association' && $this->association) {
            return $this->association->organization_name ?? ($this->full_name ?? '');
        }

        if ($this->role === 'partner' && $this->partner) {
            return $this->partner->organization_name ?? ($this->full_name ?? '');
        }

        return (string) ($this->full_name ?? '');
    }

    /**
     * Get the user's avatar URL
     */
    public function getAvatarUrlAttribute(): string
    {
        // If user has uploaded an avatar
        if ($this->avatar && \Storage::disk('public')->exists($this->avatar)) {
            return asset('storage/' . $this->avatar);
        }

        // Return default avatar using UI Avatars service
        $name = $this->display_name;
        $background = match($this->role) {
            self::ROLE_ASSOCIATION => '4CAF50',  // Green
            self::ROLE_SUPPLIER => 'FF9800',      // Orange
            self::ROLE_PARTNER => '2196F3',       // Blue
            self::ROLE_VOLUNTEER => '9C27B0',     // Purple
            self::ROLE_ADMIN => 'F44336',         // Red
            default => '4CAF50',
        };

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&size=200&background=' . $background . '&color=fff';
    }

    /**
     * Get role-specific data as array
     */
    public function getRoleSpecificData(): array
    {
        $profile = $this->roleProfile();

        if (!$profile) {
            return [];
        }

        return $profile->toArray();
    }

    /**
     * Scope to filter users by role
     */
    public function scopeRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    // ==================== BOOT METHOD ====================

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        // When a user is deleted, their role profile will be deleted automatically
        // due to the onDelete('cascade') in migrations
    }
}
