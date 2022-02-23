<?php

namespace App\Observers;

use App\Mail\AccountInformation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user) {
        if (is_null($user->password)) {
            $generatePassword = Str::random(12);
            $user->password = bcrypt($generatePassword);
            Mail::to($user->email)->send(new AccountInformation($generatePassword));
        }
    }
}
