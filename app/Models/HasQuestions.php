<?php

namespace App\Models;

trait HasQuestions
{
    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }

    public function attempts()
    {
        return $this->morphMany(Attempt::class, 'attemptable');
    }
}
