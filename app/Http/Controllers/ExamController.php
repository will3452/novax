<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Answer;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function take(Exam $exam)
    {
        if (!count(auth()->user()->userExams()->where('exam_id', $exam->id)->get())) {
            auth()->user()->userExams()->create([
                'exam_id'=>$exam->id,
                'module_id'=>$exam->module_id,
                'score'=>0,
            ]);
        }

        return view('exams.show', compact('exam'));
    }

    public function calculate(Exam $exam)
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

        $data = auth()->user()->userExams()->where('exam_id', $exam->id)->first()->update([
            'score'=>$score
        ]);

        $perfectScore = $exam->questions()->count();

        $remark = $score == $perfectScore ? "Excellent! you got perfect score!":"Good Job!";
        return view('exams.results', compact('exam', 'score', 'perfectScore'))->with(['remark'=>$remark]);
    }
}
