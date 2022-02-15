<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'datetime',
        'approved_at',
        'status',
        'notes',
    ];

    const STATUS_PENDING = 'Pending';
    const STATUS_DONE = 'Done';
    const STATUS_DECLINED = 'Declined';

    protected $casts = [
        'datetime' => 'datetime',
        'approved_at' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
