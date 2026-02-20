<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefusalForm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profile_id',
        'date',
        'reasons',
        'witness_by',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }
}
