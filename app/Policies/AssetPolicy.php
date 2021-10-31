<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
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
        return $user->can('view asset list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Asset $asset)
    {
        return $user->can('view asset details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create asset');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Asset $asset)
    {
        return $user->can('update asset');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Asset $asset)
    {
        return $user->can('delete asset');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Asset $asset)
    {
        return $user->can('restore asset');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Asset $asset)
    {
        return $user->can('force delete asset');
    }
}
