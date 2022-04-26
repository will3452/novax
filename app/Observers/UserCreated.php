<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\User;

class UserCreated
{
    public static function created(User $user)
    {
        $user->age = Carbon::parse($user->birthdate)->age;
        $user->save();
    }
}
