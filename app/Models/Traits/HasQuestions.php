<?php
namespace App\Models\Traits;

use App\Models\Question;

trait HasQuestions
{
    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }
}
