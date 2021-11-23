<?php

namespace App\Policies;

use App\Models\Counselling;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CounsellingPolicy
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
     * @param  \App\Models\Counselling  $counselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Counselling $counselling)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Counselling  $counselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Counselling $counselling)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Counselling  $counselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Counselling $counselling)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Counselling  $counselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Counselling $counselling)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Counselling  $counselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Counselling $counselling)
    {
        return true;
    }

    public function attachAnyStudent(User $user, Counselling $counselling)
    {
        return $counselling->status === Counselling::STATUS_DRAFTED;
    }
}
