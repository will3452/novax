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
        'slot',
    ];

    protected $casts = ['date' => 'date'];

    public function patient () {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public static function getSlots() {
        return [
            '9:00 AM - 9:20 AM' => '9:00 AM - 9:20 AM',
            '9:20 AM - 9:40 AM' => '9:20 AM - 9:40 AM',
            '9:40 AM - 10:00 AM' => '9:40 AM - 10:00 AM',
            '10:00 AM - 10:20 AM' => '10:00 AM - 10:20 AM',
            '10:20 AM - 10:40 AM' => '10:20 AM - 10:40 AM',
            '10:40 AM - 11:00 AM' => '10:40 AM - 11:00 AM',
            '11:00 AM - 11:20 AM' => '11:00 AM - 11:20 AM',
            '11:20 AM - 11:40 AM' => '11:20 AM - 11:40 AM',
            '11:40 AM - 12:00 PM' => '11:40 AM - 12:00 PM',
            '1:00 PM - 1:20 PM' => '1:00 PM - 1:20 PM',
            '1:20 PM - 1:40 PM' => '1:20 PM - 1:40 PM',
            '1:40 PM - 2:00 PM' => '1:40 PM - 2:00 PM',
            '2:00 PM - 2:20 PM' => '2:00 PM - 2:20 PM',
            '2:20 PM - 2:40 PM' => '2:20 PM - 2:40 PM',
            '2:40 PM - 3:00 PM' => '2:40 PM - 3:00 PM',
            '3:00 PM - 3:20 PM' => '3:00 PM - 3:20 PM',
            '3:20 PM - 3:40 PM' => '3:20 PM - 3:40 PM',
            '3:40 PM - 4:00 PM' => '3:40 PM - 4:00 PM',
            '4:00 PM - 4:20 PM' => '4:00 PM - 4:20 PM',
            '4:20 PM - 4:40 PM' => '4:20 PM - 4:40 PM',
            '4:40 PM - 5:00 PM' => '4:40 PM - 5:00 PM',
        ];
    }
}
