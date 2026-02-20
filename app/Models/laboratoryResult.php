<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaboratoryResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profile_id',
        'bedroom_number',
        'date_and_time',
        'case_record_number',
        'notes',
    ];

    protected $casts = [
        'date_and_time' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }
}
