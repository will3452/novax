<?php

namespace App\Observers;

use App\Models\Exam;

class ExamObserver
{
    public function creating(Exam $exam)
    {
        $exam->teacher_id = auth()->id();
    }
}
