<?php

namespace App\Policies;

use App\Models\GeneralJournalRemark;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralJournalPolicy
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
        return $user->can('view general journal list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GeneralJournalRemark  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, GeneralJournalRemark $account)
    {
        return $user->can('view general journal details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create general journal');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GeneralJournalRemark  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GeneralJournalRemark $account)
    {
        return $user->can('update general journal');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GeneralJournalRemark  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GeneralJournalRemark $account)
    {
        return $user->can('delete general journal');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GeneralJournalRemark  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GeneralJournalRemark $account)
    {
        return $user->can('restore general journal');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GeneralJournalRemark  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GeneralJournalRemark $account)
    {
        return $user->can('force delete general journal');
    }
}
