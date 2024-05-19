<?php

namespace App\Policies;

use App\Models\SectionStudent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionStudentPolicy
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
     * @param  \App\Models\SectionStudent  $sectionStudent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SectionStudent $sectionStudent)
    {
        if ($user->isCoordinator()) return true; 
        
        return $user->id == $sectionStudent->student_id; 
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
        return $user->isCoordinator();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SectionStudent  $sectionStudent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SectionStudent $sectionStudent)
    {
        if ($user->id == $sectionStudent->student_id) return true; 
        //
        return $user->isCoordinator();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SectionStudent  $sectionStudent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SectionStudent $sectionStudent)
    {
        //
        return $user->isCoordinator();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SectionStudent  $sectionStudent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SectionStudent $sectionStudent)
    {
        //
        return $user->isCoordinator();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SectionStudent  $sectionStudent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SectionStudent $sectionStudent)
    {
        //
        return $user->isCoordinator();
    }
}
