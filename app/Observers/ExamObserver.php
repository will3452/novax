<?php

namespace App\Observers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewExamHasBeenCreatedNotification;

class ExamObserver
{
    public function created(Exam $exam)
    {
        $users = User::where([
            'strand' => $exam->strand,
            'level' => $exam->level,
        ])->get();

        foreach ($users as $user) {
            Notification::send($user, new NewExamHasBeenCreatedNotification($exam));
        }
    }
}
