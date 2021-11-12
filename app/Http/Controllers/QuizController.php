<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
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
}
