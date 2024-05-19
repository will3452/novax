<?php

namespace App\Policies;

use App\Models\Title;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TitlePolicy
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
        return true; 
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Title $title)
    {
        if ($user->isCoordinator()) return true; 
        if ($user->id == $title->creator_id) return true; 
        if ($user->isStudent()) return true; 
        return false; 
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->isFaculty()) return true; 
        if ($user->isCoordinator()) return true; 
        if ($user->isStudent()) return true; 
        return false; 
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Title $title)
    {
        if ($user->isFaculty()) return true; 
        if ($user->isCoordinator()) return true; 
        if ($user->id == $title->creator_id) return true; 
        if ($user->isStudent()) return true; 
        return false; 
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Title $title)
    {
        return false; 
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Title $title)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Title $title)
    {
        //
    }
}
