<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
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
        return $user->can('view record list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Record $record)
    {
        return $user->can('view record details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create record');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Record $record)
    {
        return $user->can('update record');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Record $record)
    {
        return $user->can('delete record');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Record $record)
    {
        return $user->can('restore record');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Record $record)
    {
        return $user->can('force delete record');
    }
}
