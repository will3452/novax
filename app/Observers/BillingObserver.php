<?php

namespace App\Observers;

use App\Models\Billing;
use App\Models\RoomStudent;
use Illuminate\Support\Str;

class BillingObserver
{
    public function creating(Billing $billing) {
        $billing->reference = Str::random(16);
        $billing->payee_id = auth()->id();

        $user = $billing->payer_id;

        $dorm = RoomStudent::whereStudentId($user)->latest()->first()->room;
        $billing->room_id = $dorm->id;
    }
}
