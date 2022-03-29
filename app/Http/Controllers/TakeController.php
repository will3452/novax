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
        $questions = $record->exam->questions;
        $total = count($questions);
        $points = 0;

        $answers = $request->a;

        //store answer
        foreach($questions as $key => $value) {
            $ans = $answers[$key];
            $record->answers()->create([
                'value' => is_array($ans) ? implode(',', $ans): $value,
                'question_id' => $questions[$key]->id,
            ]);
        }

        if (! $record->exam->is_manual_checking) {
            foreach ($records->answers as $key => $value) {
                if (Question::isCorrect($questions[$key], $value->value)) {
                    $points ++;
                    $value->update(['satatus' => 1]);
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
