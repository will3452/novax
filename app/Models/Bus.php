<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $fillable = [
        'capacity',
        'plate_number',
        'company_name',
        'time_id',
        'trip_id',
    ];
    public function users () {
        return $this->belongsToMany(User::class);
    }

    public function time () {
        return $this->belongsTo(Time::class);
    }
    public function trip () {
        return $this->belongsTo(Trip::class);
    }

    public function bookings () {
        return $this->hasMany(Booking::class);
    }
}
