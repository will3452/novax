<?php

namespace App\Policies;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassRoomPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('view any class');
    }

    public function view(User $user, ClassRoom $classRoom)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->can('create class');
    }

    public function update(User $user, ClassRoom $classRoom)
    {
        return $user->can('update class');
    }

    public function delete(User $user, ClassRoom $classRoom)
    {
        return $user->can('delete class');
    }

   public function attachUser(User $user, ClassRoom $classRoom){
       return false;
   }
}
