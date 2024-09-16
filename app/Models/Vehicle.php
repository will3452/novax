<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number',
        'model',
        'capacity',
        'is_available',
        'driver_id',
    ]; 

    public function driver () {
        return $this->belongsTo(Driver::class, 'driver_id'); 
    }
}
