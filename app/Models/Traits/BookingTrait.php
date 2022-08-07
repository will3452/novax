<?php

namespace App\Models\Traits;

use App\Models\Booking;

trait BookingTrait
{
    public function bookings () {
        return $this->hasMany(Booking::class, 'user_id');
    }
}
