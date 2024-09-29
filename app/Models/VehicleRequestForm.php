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
        'remarks',
        'request_travel',
        'travel_order', 
        'status', 
    ];

    public function user () {
        return $this->belongsTo(User::class); 
    }

    protected $casts = [
        'date' => 'date', 
    ];
}
