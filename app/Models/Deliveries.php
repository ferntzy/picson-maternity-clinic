<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deliveries extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profile_id',
        'time_of_delivery',
        'type_of_delivery',
    ];

    protected $casts = [
        'time_of_delivery' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }

    public function newborns()
    {
        return $this->hasMany(Newborns::class, 'delivery_id');
    }
}
