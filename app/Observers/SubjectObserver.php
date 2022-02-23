<?php

namespace App\Observers;

use App\Models\Subject;
use App\Observers\Traits\HasCode;

class SubjectObserver
{
    use HasCode;
    public function creating(Subject $subject)
    {
        $subject->code = $this->generateCode($subject);
    }
}
