<?php

namespace App\Observers;

use App\Models\Appointment;

class AppointmentObserver
{
    public function creating(Appointment $appointment)
    {
        if (is_null($appointment->user_id)) {
            $appointment->user_id = auth()->id();
        }
    }
}
