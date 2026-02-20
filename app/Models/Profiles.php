<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profiles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiles';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'address',
        'sex',
        'birth_place',
        'civil_status',
        'religion',
        'nationality',
        'birth_date',
        'emergency_contact_name',
        'emergency_contact_number',
        'philhealth_number',
        'blood_type',
        'allergies',
        'contact_num',
        // 'users_id',   // ← only add if this column actually exists (creator reference)
    ];

    protected $casts = [
        'birth_date' => 'date',           // important for DatePicker
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The user account linked to this profile (one-to-one)
     */
    public function user()
    {
        return $this->hasOne(User::class, 'profile_id');
    }

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
            // Use only the first letter of the first middle name word
            $firstMiddleWord = explode(' ', $middlename)[0] ?? '';
            $middleInitial = ' ' . strtoupper(substr($firstMiddleWord, 0, 1)) . '.';
        }

        return trim("{$first}{$middleInitial} {$last}");
    }
}
