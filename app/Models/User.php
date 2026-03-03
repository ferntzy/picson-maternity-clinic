<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'email',
        'password',
        'avatar',
        'profile_id',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
        // ↑ IMPORTANT: use Profile::class (singular), not Profiles::class
    }

    // Optional alias (if old code still uses ->patient())
    public function patient()
    {
        return $this->profile();
    }

    /**
     * Get the user's primary role record from Spatie
     * Faster than roles()->first() as it uses the denormalized role_id
     */
    public function role()
    {
        return $this->belongsTo(\Spatie\Permission\Models\Role::class, 'role_id');
    }

    /**
     * This is what Filament uses for display name (avatar dropdown, breadcrumbs, etc.)
     */
    public function getFilamentName(): string
    {
        // Delegate to the profile's fullname accessor
        if ($this->profile && $this->profile->fullname) {
            return $this->profile->fullname;
        }

        // Fallbacks
        return $this->email ?: ('User #' . $this->id);
    }

    /**
     * Optional: also provide a full_name accessor on User that does the same
     */
    public function getFullNameAttribute(): string
    {
        return $this->getFilamentName();
    }

    /**
     * Get the user's primary role from Spatie
     */
    public function getRole(): ?string
    {
        return $this->roles()->first()?->name;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'auth') {
            return true;
        }

        return match ($panel->getId()) {
            'director' => $this->hasRole('director'),
            'admin'    => $this->hasRole('admin'),
            'doctor'   => $this->hasRole('doctor'),
            'nurse'    => $this->hasRole('nurse'),
            'patient'  => $this->hasRole('patient'),
            default    => false,
        };
    }

    public function createdProfiles()
    {
        return $this->hasMany(Profiles::class, 'created_by');
        // or 'users_id' — change the foreign key if needed
    }
}
