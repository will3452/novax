<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'type',
        'description',
        'medication',
        'dosage',
        'start_date',
        'end_date',
        'doctor',
        'outcome',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function patient () {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
