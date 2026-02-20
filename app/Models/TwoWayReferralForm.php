<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TwoWayReferralForm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profile_id',
        'reason_for_referral',
        'reffered_to',   // keep spelling as-is
        'patient_category',
        'health_insurance',
        'charity',
        'pay',
        'admitting_impression',
        'systolic_bp',
        'diastolic_bp',
        'pulse_rate',
        'respiratory_rate',
        'temperature',
        'weight',
        'reffered_by',   // keep spelling as-is
        'designation',
        'contact_number',
    ];

    protected $casts = [
        'patient_category' => 'boolean',
        'charity' => 'boolean',
        'pay' => 'boolean',
        'temperature' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }

    public function returnOrDischargeSlips()
    {
        return $this->hasMany(ReturnOrDischargeSlip::class, 'referral_form_id');
    }
}
