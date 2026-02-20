<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcknowledgementReceipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'referral_form_id',
        'profile_id',
        'date',
        'status_upon_receipt_at_er',
        'actions_taken',
        'receiving_hospital',
        'contact_person',
        'contact_number',
    ];

    protected $casts = [
        'date' => 'date',
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
