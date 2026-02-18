<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rpr',
        'hiv',
        'hemoglobin',
        'date_time_admitted',
        'date_time_discharged',
        'stage_of_labor',
        'patient_id',
        'form_type',
        'consent_details',
        'consent_given',
        'consent_date',
        'consent_by',
        'consent_relationship',
        'special_instructions',
        'discharge_status',
        'baby_status',
        'baby_weight',
        'discharge_notes',
        'follow_up_instructions',
    ];

    protected $casts = [
        'hemoglobin' => 'decimal:2',
        'baby_weight' => 'decimal:2',
        'date_time_admitted' => 'datetime',
        'date_time_discharged' => 'datetime',
        'consent_date' => 'date',
        'consent_given' => 'boolean',
    ];

    // Relationship: Admission belongs to Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
