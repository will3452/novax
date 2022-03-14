<?php

namespace App\Observers;

use App\Mail\AccountInformation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    public function creating(User $user)
    {
        if (strlen($user->password )) {
            return;
        }
        $password = \Str::random(16); // generate 16 random characters
        $user->password = bcrypt($password);
        Mail::to($user)->send(new AccountInformation($user, $password));
    }
}
