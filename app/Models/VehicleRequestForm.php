<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRequestForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'model',
        'purpose',
        'date',
        'time',
        'remarks',
        'request_travel',
        'travel_order',
        'status',
        'signature',
        'driver_id',
        'p_lat',
        'p_long',
        'd_lat',
        'd_long',
        'vehicle_id',
        'travel_order_id',
        'request_of_travel_id',
        'category',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function driver () {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function vehicle () {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function travelOrder() {
        return $this->belongsTo(TravelOrder::class, 'travel_order_id');
    }

    public function requestOfTravel() {
        return $this->belongsTo(RequestOfTravel::class, 'request_of_travel_id');
    }


    protected $casts = [
        'date' => 'date',
    ];
}
