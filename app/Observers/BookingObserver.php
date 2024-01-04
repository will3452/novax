<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function created(Booking $booking)
    {
        //
    }

    /**
     * Handle the Booking "updated" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function updated(Booking $booking)
    {
        //
        if($booking->status == 'APPROVED') {
            Mail::raw("Your booking has been approved by the admin, you may now proceed to payment.", function ($message) use($booking) {
                $message->subject('Booking update')->to($booking->user->email); 
            });
        } else {
            Mail::raw("Your booking status has been updated.", function ($message) use($booking) {
                $message->subject('Booking update')->to($booking->user->email); 
            });
        }

    }

    /**
     * Handle the Booking "deleted" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function deleted(Booking $booking)
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function restored(Booking $booking)
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function forceDeleted(Booking $booking)
    {
        //
    }
}
