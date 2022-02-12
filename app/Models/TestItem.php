<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'name',
        'date',
        'result',
        'conducted_by',
        'diagnosis_summary',
    ];


    protected $casts = [
        'date' => 'datetime',
    ];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
