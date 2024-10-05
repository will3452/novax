<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'condition',
        'diagnosis_date',
        'allergies',
        'family_history',
        'prev_hospitalization',
        'doctor',
        'last_visit_date',
        'notes',
    ];

    protected $casts = [
        'last_visit_date' => 'date',
        'diagnosis_date' => 'date',
    ];

    public function patient () {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
