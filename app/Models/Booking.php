<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'channel',//what method used
        'mobile_number',
        'approver_id',
        'room_id',
        'status',
        'reference_number',
        'arrival',//time in
        'departure',//time out
        'total_cost',
        'discount',
    ];

    const BOOKING_STATUS_PENDING = 'pending';
    const BOOKING_STATUS_APPROVED = 'approved';
    const BOOKING_STATUS_DISAPPROVED = 'disapproved';

    const BOOKING_CHANNEL_WEBSITE = 'website';
    const BOOKING_CHANNEL_WALK_IN = 'walk-in';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver(){
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    protected $casts = [
        'arrival' => 'datetime',
        'departure' => 'datetime',
    ];

}
