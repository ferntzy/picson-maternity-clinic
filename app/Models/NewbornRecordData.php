<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewbornRecordData extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'newborn_id',
        'assessment_type', 
        'item',
        'value',
    ];

    public function newborn()
    {
        return $this->belongsTo(Newborns::class, 'newborn_id');
    }
}
