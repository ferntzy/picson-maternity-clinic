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
        'role',
        'profile_id',     // foreign key to profiles / patients table
        // Add any other real columns you have (e.g. 'email_verified_at' if used)
    ];

    protected $hidden = [
        'password',
        'remember_token',   // ← usually good to hide this too
    ];

    protected $casts = [
        'password' => 'hashed',
        // 'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The patient/profile record this user account is linked to.
     */
    public function patient()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
        // If your model is named Profiles.php → change to Profiles::class
    }

    /**
     * Inverse: if needed (rare for this setup)
     */
    // public function profile() { ... } // alias if you prefer

    /**
     * For Filament: custom display name in top bar, breadcrumbs, etc.
     */
    public function getFilamentName(): string
    {
        $parts = array_filter([
            trim($this->patient?->firstname ?? ''),
            trim($this->patient?->middlename ?? ''),
            trim($this->patient?->lastname ?? ''),
        ]);

        if (empty($parts)) {
            return $this->email ?: ('User #' . $this->id);
        }

        return implode(' ', $parts);
    }

    /**
     * Optional: simple accessor if you want $user->full_name elsewhere
     */
    public function getFullNameAttribute(): string
    {
        return $this->getFilamentName(); // reuse logic
    }

    /**
     * Control access to different Filament panels based on role
     */
    public function canAccessPanel(Panel $panel): bool
    {
        $role = strtolower(trim($this->role ?? ''));

        // Always allow access to the default/auth/login panel
        if ($panel->getId() === 'auth') {
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

    /**
     * If users (e.g. staff) can create patients and you have users_id column on profiles/patients
     */
    public function createdPatients()
    {
        return $this->hasMany(Profiles::class, 'users_id');
        // Remove this method if you don't have users_id column
    }
}
