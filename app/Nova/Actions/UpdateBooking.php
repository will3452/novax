<?php

namespace App\Nova\Actions;

use App\Models\Booking;
use App\Models\Slot;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateBooking extends Action
{
    use InteractsWithQueue, Queueable;

    public function escalateBookings ($booking) {
        $slot = Slot::whereIsAvailable(true)->first(); 
        if (! $slot) {
            $booking->update([
                'status' => 'Rejected',
                'driver_id' => 1, // admin 
            ]);
            return;
        }

        $booking->update([
            'driver_id' => $slot->user_id,
        ]); 
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $firstModel = $models[0]; 

        // check status if valid 
        if ($firstModel->status != Booking::STATUS_PENDING) return Action::danger('Booking is ready confirmed/Done.'); 
        // escalation for rejected 
        if ($fields['status'] == 'Rejected') {
            $this->escalateBookings($firstModel);
            return; 
        }

        $firstModel->update([
            'payable' => $fields['payable'], 
            'status' => $fields['status'], 
        ]);

        Slot::whereUserId(auth()->id())->whereIsAvailable(true)->first()->update(['is_available' => false]); 
        $bookings = Booking::whereStatus(Booking::STATUS_PENDING)->get(); 
        foreach($bookings as $booking) {
            $this->escalateBookings($booking); 
        }
        return Action::message('Action Done!'); 
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Action', 'status')
                ->options([
                    'Confirmed' => 'Confirm',
                    'Rejected' => 'Reject',
                ]),
            Text::make('Payable')->help('IF CONFIRMED.'),
        ];
    }
}
