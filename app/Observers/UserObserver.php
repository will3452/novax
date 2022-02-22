<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\AccountDefaultPassword;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    public function creating(User $user)
    {
        $generatedPassword = Str::random(8);
        if (is_null($user->password)) {
            $user->password = bcrypt($generatedPassword);
        }

        Mail::to($user->email)->send(new AccountDefaultPassword($user, $generatedPassword));
    }
}
