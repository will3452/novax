<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {

        if (! Role::whereName($user->role ?? User::ROLE_PATIENT)->exists()) {
            Role::create(['name' => $user->role ?? User::ROLE_PATIENT]);
        }
        if (! $user->hasRole(Role::SUPERADMIN) && User::count() != 1) {
            $user->assignRole($user->role ?? User::ROLE_PATIENT);
        }

    }
}
