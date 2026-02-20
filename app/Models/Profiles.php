<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profiles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiles'; // optional, Laravel guesses correctly

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
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Deliveries for this profile
    public function deliveries()
    {
        return $this->hasMany(Deliveries::class, 'profile_id');
    }

    // Notes for this profile
    public function notes()
    {
        return $this->hasMany(Notes::class, 'profile_id');
    }

    // Optional: link to user account if needed later
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
