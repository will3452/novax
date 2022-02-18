<?php

namespace App\Observers;

use App\Models\Quiz;
use App\Notifications\NewQuizCreated;
use Illuminate\Support\Facades\Notification;

class QuizObserver
{
    public function created(Quiz $quiz)
    {
        $students = $quiz->module->course->userCourses;

        foreach ($students as $student) {
            $user = $student->user;
            Notification::send($user, new NewQuizCreated($quiz->module_id));
        }
    }
}
