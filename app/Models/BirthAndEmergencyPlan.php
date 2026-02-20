<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BirthAndEmergencyPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'deliver_at',
        'phi_accredited',
        'phi_member',
        'estimated_cost',
        'payment_mode',
        'available_transport_to_facility',
        'communicated_with',
        'accompanied_with',
        'children_taken_care_by',
        'emergency_number',
        'profile_id',
    ];

    protected $casts = [
        'phi_accredited' => 'boolean',
        'phi_member' => 'boolean',
        'estimated_cost' => 'integer',
    ];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }
}
