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
        'profile_id',     // foreign key → profiles.id
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

    /**
     * The profile this user account is linked to.
     */
    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }

    /**
     * Optional alias if some code still expects ->patient()
     */
    public function patient()
    {
        return $this->profile();
    }

    /**
     * Filament display name (top bar, etc.) – pulls from linked profile
     */
    public function getFilamentName(): string
    {
        if ($this->profile) {
            return $this->profile->fullname;  // uses getFullnameAttribute() on Profile
        }

        return $this->email ?: ('User #' . $this->id);
    }

    /**
     * Optional simple accessor for $user->full_name
     */
    public function getFullnameAttribute(): string
{
    $first = trim($this->firstname ?? '');
    $last  = trim($this->lastname ?? '');

    if (empty($first) && empty($last)) {
        return 'Unnamed';
    }

    $middleInitial = '';
    $middlename = trim($this->middlename ?? '');

    if ($middlename !== '') {
        // Take the first letter of the first word in middlename
        $firstWord = explode(' ', $middlename)[0];
        $middleInitial = ' ' . strtoupper(substr($firstWord, 0, 1)) . '.';
    }

    return trim("{$first}{$middleInitial} {$last}");
}

    /**
     * Panel access based on role
     */
    public function canAccessPanel(Panel $panel): bool
    {
        $role = strtolower(trim($this->role ?? ''));

        // Always allow auth/login panel
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
     * If staff users create profiles/patients and you have 'created_by' or 'users_id' on profiles
     */
    public function createdProfiles()
    {
        return $this->hasMany(Profiles::class, 'created_by');
        // Adjust foreign key if it's 'users_id' instead
    }
}
