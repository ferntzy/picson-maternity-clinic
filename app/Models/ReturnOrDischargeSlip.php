<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnOrDischargeSlip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profile_id',
        'referral_form_id',
        'date_admitted',
        'date_discharge',
        'final_diagnosis',
        'action_taken',
        'recommendation',
        'attend_by',
        'designation',
        'contact_number',
    ];

    protected $casts = [
        'date_admitted' => 'date',
        'date_discharge' => 'date',
    ];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }

    public function referralForm()
    {
        return $this->belongsTo(TwoWayReferralForm::class, 'referral_form_id');
    }
}
