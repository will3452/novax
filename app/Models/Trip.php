<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'pickup_location', 
        'dropoff_location', 
        'pickup_time', 
        'dropoff_time', // estimated
        'day',  
        'pickup_lat',
        'pickup_lng',
        'dropoff_lat',
        'dropoff_lng', 
    ];

    public function vehicle () {
        return $this->belongsTo(Vehicle::class, 'vehicle_id'); 
    }
}
