<?php

namespace App\Observers;

use App\Models\Appointment;

class AppointmentObserver
{
    public function  creating (Appointment $app) {
        $app->user_id = auth()->id() ?? 1;
    }
}
