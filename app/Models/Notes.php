<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profile_id',
        'date_and_time',
        'notes',
        'bedroom_number',
        'case_number',
        'attended_by',
        'order_type',
    ];

    protected $casts = [
        'date_and_time' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }
}
