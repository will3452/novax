<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        if (isset($request->question_image)) {
            $request->question_image = $request->question_image->store('public');
        }

        $exam->questions()->create([
            'question' => $request->question,
            'question_image' => $request->question_image,
            'type' => $request->type,
            'answer' => $request->answer,
            'choices' => $request->choices,
        ]);

        return back()->withSuccess('success!');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return back()->withSuccess('Success!');
    }
}
