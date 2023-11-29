<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'departure',
        'bus_id',
        'route_id', 
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function route() {
        return $this->belongsTo(Route::class, 'route_id'); 
    }

    public function bookings () {
        return $this->hasMany(Booking::class, 'schedule_id'); 
    }
}
