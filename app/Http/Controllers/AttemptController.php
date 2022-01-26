<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Quiz;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    // this will create new entry of attempt
    public function createAttempt($model): bool
    {
        return (bool) $model->attempts()->create([
            'user_id' => auth()->id(),
            'status' => Attempt::STATUS_IN_PROGRESS,
        ]);
    }

    //check if the user has already attempt the quiz/exam
    public function checkAttempt($model)
    {
        return auth()->user()->checkAttempt(get_class($model), $model->id);
    }

    //get the latest attempt of the user
    public function getAttempt($model)
    {
        return Attempt::whereUserId(auth()->id())
            ->whereAttemptableType(get_class($model))
            ->whereAttemptableId($model->id)
            ->latest()
            ->first();
    }

    public function renderQuestions($model)
    {
        return 'questions has been rendered';
    }


    //handler for quiz
    function attemptQuiz(Quiz $quiz) {
        //check if the quiz is open
        if (! $quiz->isOpen()) {
            return "Quiz is not available!";
        }

        // check if the user is belong to the quiz
        $isExist = UserCourse::whereUserId(auth()->id())
            ->whereCourseId($quiz->module->course_id)
            ->first();

        if (is_null($isExist)) {
            return abort(403);
        }

        //check if the user already attempted the quiz
        if ($this->checkAttempt($quiz)) {
            $attempt = $this->getAttempt($quiz);

            //check if the attempt is in progress
            if($attempt->status !== Attempt::STATUS_IN_PROGRESS) {
                return 'you already take the this!';
            }

            //render the questions
            return $this->renderQuestions($quiz);
        }

        //create new attempt
        $this->createAttempt($quiz);

        //render the questions
        return $this->renderQuestions($quiz);
    }
}
