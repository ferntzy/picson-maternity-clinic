<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'patient';
    protected $fillable = [
        'address',
        'sex',
        'birth_place',
        'civil_status',
        'religion',
        'nationality',
        'contact_number',
        'birth_date',
        'spouse_name',
        'spouse_contact_number',
        'philhealth_number',
        'blood_type',
        'allergies',
        'gravida',
        'term_birth',
        'pre_term_birth',
        'abortion',
        'living_children',
        'users_id',
    ];

    // Who created this patient record
    public function creator()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // The patient’s own user account
    public function userAccount()
    {
        return $this->hasOne(User::class, 'patient_id');
    }
}
