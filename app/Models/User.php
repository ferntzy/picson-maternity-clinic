<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'email',
        'password',
        'firstname',
        'middlename',
        'lastname',
        'patient_id',
        'username',
        'contact_num',
        'avatar',
        'role',

    ];

    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    public function getFilamentName(): string
    {
        $first = trim($this->firstname ?? '');
        $last  = trim($this->lastname ?? '');
        $middleRaw = trim($this->middlename ?? '');

        if (empty($first) && empty($last)) {
            return $this->email ?: ('User #' . $this->id);
        }

        $middleInitials = '';
        if ($middleRaw !== '') {
            // Split on spaces (handles multiple middle names)
            $middleParts = preg_split('/\s+/', $middleRaw, -1, PREG_SPLIT_NO_EMPTY);
            $initials = array_map(fn($part) => strtoupper(substr($part, 0, 1)) . '.', $middleParts);
            $middleInitials = ' ' . implode(' ', $initials);
        }

        return trim("{$first}{$middleInitials} {$last}");
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $first = trim($this->firstname ?? '');
                $last  = trim($this->lastname ?? '');
                $middleRaw = trim($this->middlename ?? '');

                if (empty($first) && empty($last)) {
                    return $this->email ?: ('User #' . $this->id);
                }

                $middleInitials = '';
                if ($middleRaw !== '') {
                    $middleParts = preg_split('/\s+/', $middleRaw, -1, PREG_SPLIT_NO_EMPTY);
                    $initials = array_map(fn($part) => strtoupper(substr($part, 0, 1)) . '.', $middleParts);
                    $middleInitials = ' ' . implode(' ', $initials);
                }

                return trim("{$first}{$middleInitials} {$last}");
            }
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $role = strtolower(trim($this->role ?? ''));

        return match ($panel->getId()) {
            'auth'     => true, // allow login panel always
            'director' => $role === 'director',
            'admin'    => $role === 'admin',
            'doctor'   => $role === 'doctor',
            'nurse'    => $role === 'nurse',
            'patient'   => $role === 'patient',
            default    => false,
        };
    }

    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // If this user is linked to a patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    // If this user is a nurse/admin and created patients
    public function createdPatients()
    {
        return $this->hasMany(Patient::class, 'users_id');
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->firstname} {$this->middlename} {$this->lastname}");
    }
}
