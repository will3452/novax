<?php

namespace App\Policies;

use App\Models\IndividualCounselling;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndividualCounsellingPolicy
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
        return $user->can('view individual counselling list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IndividualCounselling  $individualCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, IndividualCounselling $individualCounselling)
    {
        return $user->can('view individual counselling details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create individual counselling');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IndividualCounselling  $individualCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, IndividualCounselling $individualCounselling)
    {
        return $user->can('update individual counselling');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IndividualCounselling  $individualCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, IndividualCounselling $individualCounselling)
    {
        return $user->can('delete individual counselling');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IndividualCounselling  $individualCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, IndividualCounselling $individualCounselling)
    {
        return $user->can('restore individual counselling');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IndividualCounselling  $individualCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, IndividualCounselling $individualCounselling)
    {
        return $user->can('force delete individual counselling');
    }
}
