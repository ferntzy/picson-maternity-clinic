<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deliveries extends Model
{
    use SoftDeletes;

    protected $table = 'deliveries';

    protected $fillable = [
        'time_of_delivery',
        'type_of_delivery',
        'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function newbornRecords()
    {
        return $this->hasMany(Newborns::class, 'deliveries_id');
    }

}
