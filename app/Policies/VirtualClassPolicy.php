<?php

namespace App\Policies;

use App\Models\VirtualClass;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VirtualClassPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view any virtual class');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualClass  $v_c
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, VirtualClass $v_c)
    {
        return $user->can('view virtual class details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create virtual class');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualClass  $v_c
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, VirtualClass $v_c)
    {
        return $user->can('update virtual class');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualClass  $v_c
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, VirtualClass $v_c)
    {
        return $user->can('delete virtual class');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualClass  $v_c
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, VirtualClass $v_c)
    {
        return $user->can('restore virtual class');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\VirtualClass  $v_c
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, VirtualClass $v_c)
    {
        return $user->can('force delete virtual class');
    }
}
