<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestOfTravel extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'user_id',
        'purpose',
        'date',
        'vehicle_id',
        'destination',
        'passengers',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function admin () {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function requestor () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehicle () {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

}
