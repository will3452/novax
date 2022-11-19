<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatLogger extends Model
{
    use HasFactory;
    protected $fillable = [
        'time_id',
        'seat',
        'booking_id',
        'bus_id',
        'date',
    ];
}
