<?php

namespace App\Policies;

use App\Models\StockTake;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockTakePolicy
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
        return $user->can('view stock take list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockTake  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, StockTake $stockReport)
    {
        return $user->can('view stock take details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create stock take');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockTake  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, StockTake $stockReport)
    {
        return $user->can('update stock take');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockTake  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, StockTake $stockReport)
    {
        return $user->can('delete stock take');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockTake  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, StockTake $stockReport)
    {
        return $user->can('restore stock take');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockTake  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, StockTake $stockReport)
    {
        return $user->can('force delete stock take');
    }
}
