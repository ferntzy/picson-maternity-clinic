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
        'email',
        'password',
        'firstname',
        'middlename',
        'lastname',
        'username',
        'contact_num',
        'avatar',
        'role',

    ];

    protected $hidden = ['password'];

    /**
     * If this user is a patient
     */
    public function patient()
    {
        return $this->hasOne(Patient::class, 'users_id');
    }

    /**
     * If this user is a nurse/admin who created patients
     */
    public function createdPatients()
    {
        return $this->hasMany(Patient::class, 'users_id');
    }

    public function getFilamentName(): string
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
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
