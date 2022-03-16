<?php

namespace App\Observers;

use App\Models\User;
use App\Models\VerificationCode;

class UserObserver
{
    public function created(User $user)
    {
        $phone = $user->phone;
        if (! is_null($phone)) { // it allows the admin to register
            VerificationCode::smsHandler($phone);
        }

    }
}
