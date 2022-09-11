<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the can view any models.
     *
     * @param  \App\Models\ $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        return $user->type == User::TYPE_ADMIN;
    }

    /**
     * Determine whether the can view the model.
     *
     * @param  \App\Models\ $user
     * @param  \App\Models\ $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, $model)
    {
        return $user->type === User::TYPE_ADMIN;
    }

    /**
     * Determine whether the can create models.
     *
     * @param  \App\Models\ $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->type === User::TYPE_ADMIN;
    }

    /**
     * Determine whether the can update the model.
     *
     * @param  \App\Models\ $user
     * @param  \App\Models\ $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, $model)
    {
        return $user->type === User::TYPE_ADMIN;
    }

    /**
     * Determine whether the can delete the model.
     *
     * @param  \App\Models\ $user
     * @param  \App\Models\ $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, $model)
    {
        return $user->type === User::TYPE_ADMIN;
    }

    /**
     * Determine whether the can restore the model.
     *
     * @param  \App\Models\ $user
     * @param  \App\Models\ $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, $model)
    {
        //
    }

    /**
     * Determine whether the can permanently delete the model.
     *
     * @param  \App\Models\ $user
     * @param  \App\Models\ $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, $model)
    {
        //
    }
}
