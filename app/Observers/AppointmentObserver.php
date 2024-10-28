<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\SlotCount;
use App\Notifications\NewAppointment;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function created(Appointment $appointment)
    {
        $users = User::whereType('Administrator')->get();
        foreach ($users as $user) {
            $user->notify(new NewAppointment($appointment));
        }
        $slotCount = SlotCount::whereDate('date', $appointment->date)->first();
        if (! $slotCount) {
            SlotCount::create([
                'date' => $appointment->date,
                'count' => 1,
            ]);
        } else {
            $slotCount->update(['count' =>  $slotCount->count + 1]);
        }
    }

    /**
     * Handle the Appointment "updated" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function updated(Appointment $appointment)
    {
        $slotCount = SlotCount::whereDate('date', $appointment->date)->first();
        if (in_array($appointment->status, ['Cancelled', 'Rejected'])) {
            $slotCount->update(['count' =>  $slotCount->count - 1]);
        }
    }

    /**
     * Handle the Appointment "deleted" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function deleted(Appointment $appointment)
    {
        //
    }

    /**
     * Handle the Appointment "restored" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function restored(Appointment $appointment)
    {
        //
    }

    /**
     * Handle the Appointment "force deleted" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function forceDeleted(Appointment $appointment)
    {
        //
    }
}
