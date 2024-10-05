<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date',
        'time_start',
        'time_end',
        'remarks',
        'service',
        'status',
    ];

    protected $casts = ['date' => 'date'];

    public function patient () {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
