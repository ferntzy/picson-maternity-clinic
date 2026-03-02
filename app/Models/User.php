<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'avatar',
        'profile_id',
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
     * Get the user's role from their profile
     */
    public function getRole(): ?string
    {
        return $this->profile?->role;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $role = strtolower(trim($this->getRole() ?? ''));

        if ($panel->getId() === 'auth') {
            return true;
        }

        // Allow the known seeded admin user into the admin panel
        // even if their profile/role linkage is temporarily misconfigured.
        if ($panel->getId() === 'admin' && $this->email === 'admin@example.com') {
            return true;
        }

        return match ($panel->getId()) {
            'director' => $role === 'director',
            'admin'    => $role === 'admin',
            'doctor'   => $role === 'doctor',
            'nurse'    => $role === 'nurse',
            'patient'  => $role === 'patient',
            default    => false,
        };
    }

    public function createdProfiles()
    {
        return $this->hasMany(Profiles::class, 'created_by');
        // or 'users_id' — change the foreign key if needed
    }
}
