<?php

namespace App\Http\Controllers;

use App\Helpers\ModelHelper;
use App\Models\Answer;
use App\Models\Attempt;
use App\Models\AttemptAnswer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    public $totalScore;
    public $totalItems;

    // this will create new entry of attempt
    public function createAttempt($model): bool
    {
        return (bool) $model->attempts()->create([
                'user_id' => auth()->id(),
                'status' => Attempt::STATUS_IN_PROGRESS,
            ]
        );
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
        // return $model;
        return view('quiz_show', compact('model'));
    }


    //handler for quiz
    function attempt() {
        request()->validate([
            'model' => 'required',
            'id' => 'required',
        ]);

        $model = (ModelHelper::origin(request()->model))::findOrFail(request()->id);
        //check if the quiz|exam is open
        if (! $model->isOpen()) {
            return "session is not available!";
        }

        // check if the user is belong to the quiz|exam
        $isExist = UserCourse::whereUserId(auth()->id())
            ->whereCourseId($model->module->course_id)
            ->first();

        if (is_null($isExist)) {
            return abort(403);
        }

        //check if the user already attempted the quiz | exam
        if ($this->checkAttempt($model)) {
            $attempt = $this->getAttempt($model);

            //check if the attempt is in progress
            if($attempt->status !== Attempt::STATUS_IN_PROGRESS) {
                return 'you already take the this!';
            }

            //render the questions
            return $this->renderQuestions($model);
        }

        //create new attempt
        $this->createAttempt($model);

        //render the questions
        return $this->renderQuestions($model);
    }

    public function extractQuestionAndAnswerId(string $submittedAnswer)
    {
        $result = explode('-', $submittedAnswer);
        $result[] = Question::findOrFail($result[0])
            ->answers()
            ->find($result[1])
            ->type;
        return $result;
    }
    public function recordAttemptAnswers($model,array $answers)
    {
        $attemptAnswers = [];
        $attempt = $this->getAttempt($model);

        // check if the attempt is already done, if done bring to error
        if ($attempt->isDone()) {
            return abort(404);
        }
        $attemptId = $attempt->id;

        foreach ($answers as $answer) {

            [$questionId, $answerId, $type] = $this
                ->extractQuestionAndAnswerId($answer);
            if ($type === Answer::TYPE_CORRECT) {
                $this->totalScore ++;
            }
            $this->totalItems ++;

            $newItem = AttemptAnswer::create([
                'attempt_id' => $attemptId,
                'question_id' => (int) $questionId,
                'answer_id' => (int) $answerId,
                'type' => $type,
            ]);

            $attemptAnswers[] = $newItem;

            //mark attempt as done
            $attempt->markAs(
                Attempt::STATUS_DONE,
                $this->totalScore,
                $this->totalItems,
            );
        }
        return $attemptAnswers;
    }

    public function checkAnswers(Request $request)
    {
        $request->validate([
            'model_type' => 'required',
            'model_id' => 'required',
            'answers' => 'required'
        ]);

        $modelType = $request->model_type;
        $model = ($modelType)::findOrFail($request->model_id);

        $results = collect($this->recordAttemptAnswers($model, $request->answers));

        $totalItems = $this->totalItems ?? 0;
        $totalScore = $this->totalScore ?? 0;

        return view(
            'result_show',
            compact(
                'results',
                'model',
                'totalItems',
                'totalScore',
            ),
        );
    }
}
