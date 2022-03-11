<?php

namespace App\Observers;

use App\Models\Question;

class QuestionObserver
{
    public function creating(Question $question)
    {
        if ($question->type === Question::TYPE_MULTIPLECHOICE) {
            $arr = [];

            if (isset($question->w_1)) {
                $arr[] = $question->w_1;
            }

            if (isset($question->w_2)) {
                $arr[] = $question->w_2;
            }

            if (isset($question->w_3)) {
                $arr[] = $question->w_3;
            }
            unset($question->w_1);
            unset($question->w_2);
            unset($question->w_3);

            $str = implode(Question::SEPARATOR, $arr);

            $question->choices = $str;
        }
    }
}
