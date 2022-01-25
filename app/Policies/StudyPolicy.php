<?php

namespace App\Policies;

use App\Models\Study;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudyPolicy
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
        return $user->can('view study list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Study  $study
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Study $study)
    {
        return $user->can('view study details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create study');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Study  $study
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Study $study)
    {
        return $user->can('update study');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Study  $study
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Study $study)
    {
        return $user->can('delete study');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Study  $study
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Study $study)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Study  $study
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Study $study)
    {
        //
    }
}
