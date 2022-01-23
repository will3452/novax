<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function take(Quiz $quiz)
    {
        if (!count(auth()->user()->userQuizzes()->where('quiz_id', $quiz->id)->get())) {
            auth()->user()->userQuizzes()->create([
                'quiz_id'=>$quiz->id,
                'module_id'=>$quiz->module_id,
                'score'=>0,
            ]);
        }

        return view('quizzes.show', compact('quiz'));
    }

    public function calculate(Quiz $quiz)
    {
        $score = 0;
        // return request()->all();
        $answers = request()->answers;
        $userAnswers = [];

        foreach ($answers as $answer) {
            [$userAnswers[],] = explode('_', $answer);
        }

        foreach ($userAnswers as $id) {
            $answer = Answer::find($id);

            if ($answer->type === Answer::TYPE_CORRECT) {
                $score ++;
            }
        }

        $data = auth()->user()->userQuizzes()->where('quiz_id', $quiz->id)->first()->update([
            'score'=>$score
        ]);

        $perfectScore = $quiz->questions()->count();

        $remark = $score == $perfectScore ? "Excellent! you got perfect score!":"Nice Try";
        return view('quizzes.result', compact('quiz', 'score', 'perfectScore'))->with(['remark'=>$remark]);
    }
}
