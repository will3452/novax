<?php

namespace App\Policies;

use App\Models\StockReport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockReportPolicy
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
        return $user->can('view stock report list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockReport  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, StockReport $stockReport)
    {
        return $user->can('view stock report details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create stock report');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockReport  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, StockReport $stockReport)
    {
        return $user->can('update stock report');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockReport  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, StockReport $stockReport)
    {
        return $user->can('delete stock report');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockReport  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, StockReport $stockReport)
    {
        return $user->can('restore stock report');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StockReport  $stockReport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, StockReport $stockReport)
    {
        return $user->can('force delete stock report');
    }
}
