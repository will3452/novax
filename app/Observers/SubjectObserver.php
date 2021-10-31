<?php

namespace App\Observers;

use App\Helpers\ReferenceHelper;
use App\Models\Subject;

class SubjectObserver
{
    public function created(Subject $subject)
    {
        $subject->update([
            'reference_number'=>ReferenceHelper::generate('SUB', $subject->id),
        ]);
    }
}
