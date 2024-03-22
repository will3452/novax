<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'passenger_id', 
        'from_coords',
        'to_coords', 
        'origin',
        'destination',
        'number_of_passenger',
        'payable', 
        'status', 
        'reference', 
    ]; 

    const STATUS_CONFIRMED = 'Confirmed';
    const STATUS_DONE = 'Done';
    const STATUS_PENDING = 'Pending'; 

    public function passenger () {
        return $this->belongsTo(User::class, 'passenger_id'); 
    }

    public function driver () {
        return $this->belongsTo(Driver::class, 'driver_id'); 
    }
}
