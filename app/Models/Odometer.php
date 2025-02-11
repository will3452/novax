<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odometer extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'start',
        'end',
        'vrf_id',
        'driver_id',
    ];

    public function vrf() {
        return $this->belongsTo(VehicleRequestForm::class, 'vrf_id');
    }

    public function driver () {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function vehicle () {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
