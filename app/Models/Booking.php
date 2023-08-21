<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'from',
        'to',
        'fare',
        'user_id',
        'discount',
        'qty',
        'date',
        'seat_numbers',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
