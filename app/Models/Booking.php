<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'from',
        'to',
        'fare',
        'user_id',
        'discount',
        'qty',
        'date',
        'seat_numbers',
        'route_id',
        'time',
        'schedule_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function schedule () {
        return $this->belongsTo(Schedule::class, 'schedule_id'); 
    }
}
