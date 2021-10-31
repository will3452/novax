<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
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
        return $user->can('view any quiz');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Quiz $quiz)
    {
        return $user->can('view quiz details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create quiz');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Quiz $quiz)
    {
        return $user->can('update quiz');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Quiz $quiz)
    {
        return $user->can('delete quiz');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Quiz $quiz)
    {
        return $user->can('restore quiz');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Quiz $quiz)
    {
        return $user->can('force delete quiz');
    }
}
