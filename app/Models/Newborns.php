<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newborns extends Model
{
    use SoftDeletes;

    protected $table = 'newborns';

    protected $fillable = [
        'sex',
        'birth_weight',
        'firstname',
        'middlename',
        'lastname',
        'date_time_of_birth',
        'head',
        'chest',
        'abdomen',
        'length',
        'newborn_screening_done',
        'inguinal_area',
        'other_findings',
        'impression',
        'management',
        'case_number',
        'deliveries_id',
        'users_id',
        'patient_id',
    ];

    public function delivery()
    {
        return $this->belongsTo(Deliveries::class, 'deliveries_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
