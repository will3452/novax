<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'driver_id',
        'trip_id',
        'status',
        'date', 
    ]; 

    protected $casts = [
        'date' => 'date', 
    ];

    public function client () {
        return $this->belongsTo(Client::class, 'client_id'); 
    }
    public function driver () {
        return $this->belongsTo(Driver::class, 'driver_id'); 
    }
    public function trip () {
        return $this->belongsTo(Trip::class, 'trip_id'); 
    }
}
