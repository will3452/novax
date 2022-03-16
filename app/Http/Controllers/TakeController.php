<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Record;
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

        foreach ($answers as $key => $value) {
            if ($value === $questions[$key]->answer) {
                $points ++;
            }
        }
        $score = "$points/$total";
        $record->update(['score' => $score]);

        return view('take_done', compact('score', 'record'));
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
