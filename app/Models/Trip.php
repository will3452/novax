<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'pickup_location', 
        'dropoff_location', 
        'pickup_time', 
        'dropoff_time', // estimated
        'day',  
    ];

    public function driver () {
        return $this->belongsTo(Driver::class, 'driver_id'); 
    }
}
