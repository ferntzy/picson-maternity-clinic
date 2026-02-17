<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'email',
        'password',
        'role',
        'username',
        'contact_num',
        'avatar',

    ];

    protected $hidden = [
        'password',
        'remember_token',
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
        return true;
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
