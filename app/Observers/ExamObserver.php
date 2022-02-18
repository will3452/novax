<?php

namespace App\Observers;

use App\Models\Exam;
use App\Notifications\NewExamCreated;
use Illuminate\Support\Facades\Notification;

class ExamObserver
{
    public function created(Exam $exam)
    {
        $students = $exam->module->course->userCourses;

        foreach ($students as $student) {
            $user = $student->user;
            Notification::send($user, new NewExamCreated($exam->module_id));
        }
    }
}
