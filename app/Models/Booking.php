<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'patient_id',
        'date',
        'time',
        'service_id',
        'status',
        'remarks', 
    ]; 

    public function patient() {
        return $this->belongsTo(User::class, 'patient_id'); 
    }

    public function service () {
        return $this->belongsTo(Service::class, 'service_id'); 
    }
}
