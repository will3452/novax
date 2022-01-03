<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Str;

class BookingObserver
{
    public function creating(Booking $booking)
    {
        $booking->reference_number = Str::random(11) . now()->format('mdY');
    }
}
