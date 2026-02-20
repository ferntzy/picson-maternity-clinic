<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicationTimeSheet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'medication_sheet_id',
        'date',
        'am',
        'pm',
    ];

    protected $casts = [
        'date' => 'date',
        'am' => 'datetime:H:i',
        'pm' => 'datetime:H:i',
    ];

    public function medicationSheet()
    {
        return $this->belongsTo(MedicationSheet::class, 'medication_sheet_id');
    }
}
