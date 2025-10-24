<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, MustVerifyEmailTrait, Notifiable;

    // ==================== ROLE CONSTANTS ====================
    public const ROLE_ASSOCIATION = 'association';

    public const ROLE_PARTNER = 'partner';

    public const ROLE_VOLUNTEER = 'volunteer';

    public const ROLE_ADMIN = 'admin';

    public const ROLE_SUPPLIER = 'supplier';

    // ==================== ATTRIBUTES ====================
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['name', 'avatar_url', 'display_name'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ==================== ROLE HELPERS ====================
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

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isSupplier(): bool
    {
        return $this->role === self::ROLE_SUPPLIER;
    }

    // ==================== RELATIONSHIPS ====================
    public function association()
    {
        return $this->hasOne(Association::class);
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function partner()
    {
        return $this->hasOne(Partner::class);
    }

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function joinedCompetitions()
    {
        return $this->belongsToMany(
            Competition::class,
            'competition_association',
            'association_id',
            'competition_id'
        );
    }

    // ==================== ROLE PROFILE HANDLER ====================
    public function roleProfile()
    {
        return match ($this->role) {
            self::ROLE_ASSOCIATION => $this->association,
            self::ROLE_SUPPLIER => $this->supplier,
            self::ROLE_PARTNER => $this->partner,
            self::ROLE_VOLUNTEER => $this->volunteer,
            self::ROLE_ADMIN => $this->admin,
            default => null,
        };
    }

    // ==================== ACCESSORS ====================
    public function getNameAttribute(): string
    {
        return (string) ($this->full_name ?? '');
    }

    public function getDisplayNameAttribute(): string
    {
        if ($this->role === self::ROLE_SUPPLIER && $this->supplier) {
            return $this->supplier->company_name ?? $this->full_name ?? '';
        }

        if ($this->role === self::ROLE_ASSOCIATION && $this->association) {
            return $this->association->organization_name ?? $this->full_name ?? '';
        }

        if ($this->role === self::ROLE_PARTNER && $this->partner) {
            return $this->partner->organization_name ?? $this->full_name ?? '';
        }

        return (string) ($this->full_name ?? '');
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && \Storage::disk('public')->exists($this->avatar)) {
            return asset('storage/'.$this->avatar).'?v='.$this->updated_at->timestamp;
        }

        $name = $this->display_name;
        $background = match ($this->role) {
            self::ROLE_ASSOCIATION => '4CAF50',
            self::ROLE_SUPPLIER => 'FF9800',
            self::ROLE_PARTNER => '2196F3',
            self::ROLE_VOLUNTEER => '9C27B0',
            self::ROLE_ADMIN => 'F44336',
            default => '4CAF50',
        };

        return 'https://ui-avatars.com/api/?name='.urlencode($name)
            .'&size=200&background='.$background.'&color=fff';
    }

    // ==================== UTILITIES ====================
    public function getRoleSpecificData(): array
    {
        $profile = $this->roleProfile();

        return $profile ? $profile->toArray() : [];
    }

    public function scopeRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    // ==================== BOOT ====================
    protected static function boot()
    {
        parent::boot();
        // Cascade deletions handled via migrations
    }
}
