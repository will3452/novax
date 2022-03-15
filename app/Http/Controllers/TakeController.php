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
        return view('take', compact('record', 'exam'));
    }

    public function submit(Request $request, Record $record)
    {
        dd($record->screen_record);
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
