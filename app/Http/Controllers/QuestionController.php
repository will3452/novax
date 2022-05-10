<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function printq(Exam $exam)
    {
        return view('printq', compact('exam'));
    }

    public function create(Exam $exam)
    {
        return view('exam.question_create', compact('exam'));
    }

    public function update(Request $request, Question $question)
    {
        if (isset($request->question_image)) {
            $request->question_image = $request->question_image->store('public');
        }


        if (request()->type === \App\Models\Question::TYPE_ESSAY) {
            $request->answer = '';
        }

        $question->update([
            'question' => $request->question,
            'question_image' => $request->question_image,
            'type' => $request->type,
            'answer' => $request->answer,
            'choices' => $request->choices,
        ]);

        return redirect('/exams/' . $question->exam_id)->withSuccess('Question updated!');
    }
    public function store(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        if (isset($request->question_image)) {
            $request->question_image = $request->question_image->store('public');
        }


        if (request()->type === \App\Models\Question::TYPE_ESSAY) {
            $request->answer = '';
        }

        $exam->questions()->create([
            'question' => $request->question,
            'question_image' => $request->question_image,
            'type' => $request->type,
            'answer' => $request->answer,
            'choices' => $request->choices,
        ]);


        return redirect('/exams/' . $exam->id)->withSuccess('Added!');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return back()->withSuccess('Success!');
    }


    public function edit(Request $request, Question $question)
    {
        return view('exam.question_edit', compact('question'));
    }
}
