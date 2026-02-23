<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Deliveries;


class Newborns extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'delivery_id',
        'firstname',
        'middlename',
        'lastname',
        'sex',
        'birth_weight',
        'length',
        'head',
        'chest',
        'abdomen',
        'date_time_of_birth',
        'newborn_screening_done',
    ];

    protected $casts = [
        'date_time_of_birth' => 'datetime',
        'newborn_screening_done' => 'boolean',
    ];

    public function delivery()
    {
        return $this->belongsTo(Deliveries::class, 'delivery_id');
    }

    public function newborn_record_data()
    {
        return $this->hasMany(NewbornRecordData::class, 'newborn_id');
    }
}
