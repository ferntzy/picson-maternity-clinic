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
        'users_id',
        'address',
        'sex',
        'birth_place',
        'civil_status',
        'religion',
        'nationality',
        'birth_date',
        'spouse_name',
        'spouse_contact_number',
        'philhealth_number',
        'blood_type',
        'allergies',
    ];

    /**
     * The user account of the patient (role: patient)
     */
    public function user()
    {
        return $this->hasOne(User::class, 'patient_id', 'id');
    }
    /**
     * The nurse who created this patient record
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function admissions()
    {
        return $this->hasMany(Admission::class,'patient_id');
    }

}
