<?php

namespace App\Policies;

use App\Models\AccountingPeriod;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountingPeriodPolicy
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
        return $user->can('view accounting period list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccountingPeriod  $accountingPeriod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AccountingPeriod $accountingPeriod)
    {
        return $user->can('view accounting period details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create accounting period');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccountingPeriod  $accountingPeriod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AccountingPeriod $accountingPeriod)
    {
        return $user->can('update accounting period');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccountingPeriod  $accountingPeriod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AccountingPeriod $accountingPeriod)
    {
        return $user->can('delete accounting period');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccountingPeriod  $accountingPeriod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AccountingPeriod $accountingPeriod)
    {
        return $user->can('restore accounting period');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccountingPeriod  $accountingPeriod
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AccountingPeriod $accountingPeriod)
    {
        return $user->can('force delete accounting period');
    }
}
