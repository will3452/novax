<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Record;
use App\Models\Question;
use Illuminate\Http\Request;

class TakeController extends Controller
{
    public function take(Record $record)
    {
        $exam = $record->exam;
        $min = $exam->getTimeOfRecord($record);
        if ($min <= 0) {
            return 'your time is over';
        }
        $time['hh'] = intdiv($min, 60);
        $time['mm'] = $min % 60;
        return view('take', compact('record', 'exam', 'time'));
    }

    public function submit(Request $request, Record $record)
    {
        // dd($request->all());
        $qs = $request->q;
        $answers = $request->a;
        $questions = $record->exam->questions;
        $total = count($questions);
        $points = 0;


        foreach ($answers ?? [] as $qId => $ans) {
            if ($ans) {
                $newArr = $ans;
                if (Question::find($qId)->type === Question::TYPE_MULTIPLE_ANSWER) {
                    $arr = end($newArr);
                    $newArr = implode(",", $arr);
                    // dd($newArr);
                } else {
                    $newArr = end($answers[$qId]);
                }
                $record->answers()->create([
                    'value' => $newArr ?? '',
                    'question_id' =>$qId,
                ]);
            }
        }

        if (! $record->exam->is_manual_checking) {
            foreach ($record->answers as $key => $value) {
                $val = $value->question->type === Question::TYPE_MULTIPLE_ANSWER ? explode(',', $value->value) : $value->value;
                if (Question::isCorrect($value->question, $val)) {
                    $value->update(['status' => 1]);
                    $points ++;
                }
            }
        }

        $score = $record->exam->is_manual_checking ? "Not yet checked" : "$points/$total";
        $record->update(['score' => $score]);
        if ($record->exam->is_manual_checking) {
            return view('manual_check_done');
        }
        return view('loading', compact('score', 'record'));
    }

    public function takeNow(Request $request, Exam $exam)
    {
        if (! is_null($exam->code)) {
            $request->validate([
                'code' => 'required'
            ]);

            if ($exam->code != $request->code) {
                return back()->withAlert('Wrong code!');
            }
        }

        $record = Record::create([
            'exam_id' => $exam->id,
            'user_id' => auth()->id(),
            'exam_name' => $exam->name,
        ]);

        return redirect('/take/' . $record->id);
    }
}
