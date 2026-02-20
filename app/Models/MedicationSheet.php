<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicationSheet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profile_id',
        'medication',
        'case_record_number',
    ];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }
}
