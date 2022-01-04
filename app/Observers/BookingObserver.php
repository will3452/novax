<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Str;

class BookingObserver
{
    public function creating(Booking $booking)
    {
        $booking->reference_number = Str::random(11) . now()->format('mdY');

        if ($booking->channel == Booking::BOOKING_CHANNEL_WALK_IN) {
            $booking->status == Booking::BOOKING_STATUS_IN;
            $booking->room->update(['available'=>false]);
        }
    }

    public function updated(Booking $booking)
    {
        if ($booking->status == Booking::BOOKING_STATUS_IN) {
            $booking->room->update(['available'=>false]);
        } elseif ($booking->status == Booking::BOOKING_STATUS_OUT) {
            $booking->room->update(['available'=>true]);
        }
    }
}
