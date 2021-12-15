<?php

namespace App\Policies;

use App\Models\GroupCounselling;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupCounsellingPolicy
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
        return $user->can('view group counselling list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupCounselling  $groupCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, GroupCounselling $groupCounselling)
    {
        return $user->can('view group counselling details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create group counselling');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupCounselling  $groupCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GroupCounselling $groupCounselling)
    {
        return $user->can('update group counselling');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupCounselling  $groupCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GroupCounselling $groupCounselling)
    {
        return $user->can('delete group counselling');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupCounselling  $groupCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GroupCounselling $groupCounselling)
    {
        return $user->can('restore group counselling');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupCounselling  $groupCounselling
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GroupCounselling $groupCounselling)
    {
        return $user->can('force delete group counselling');
    }
}
