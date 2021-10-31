<?php

namespace App\Policies;

use App\Models\Module;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulePolicy
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
        return $user->can('view any module');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Module $module)
    {
        return $user->can('view module details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create module');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Module $module)
    {
        return $user->can('update module');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Module $module)
    {
        return $user->can('delete module');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Module $module)
    {
        return $user->can('restore module');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Module $module)
    {
        return $user->can('force delete module');
    }
}
