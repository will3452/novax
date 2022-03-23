<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Activity;
use App\Models\Question;
use Illuminate\Http\Request;

class TakeController extends Controller
{
    public function timeParser($time)
    {
        return explode(',', Carbon::parse($time)->format('H,i'));
    }

    public function hourToMinutes($time)
    {
        [$hr, $min] = $this->timeParser($time);
        $minInHr = $hr * 60;
        return $min + $minInHr;
    }


    public function remainingTime($record, $activity)
    {
        $timeTaken = now()->diffInMinutes($record->created_at);
        $timeLimit = $this->hourToMinutes($activity->time_limit);
        $givenMin = $timeLimit - $timeTaken;

        $hr = intdiv($givenMin, 60);
        $min = $givenMin % 60;
        return [$hr, $min];
    }

    public function isExpired($record, $activity)
    {
        $timeTaken = now()->diffInMinutes($record->created_at);
        $timeLimit = $this->hourToMinutes($activity->time_limit);

        return $timeLimit < $timeTaken;
    }

    public function getRecord($activity)
    {
        return $activity->records()->whereUserId(auth()->id())->first();
    }

    public function take($category, $id)
    {
        $activity = Activity::whereCategory($category)->find($id);

        $record = $this->getRecord($activity);

        if ($category === Activity::CATEGORY_PROJECT) {
            $canSubmit =  $activity->deadline > now() && is_null($record->file);
            return view('activity.submit-project', compact('activity', 'canSubmit'));
        }

        if ($this->isExpired($record, $activity)) {
            return abort(401);
        }

        $rt = $this->remainingTime($record, $activity);
        return view('activity.answer', compact('activity', 'rt'));
    }

    public function submitProject(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'file' => ['required', 'max:2000'],
        ]);

        $path = $data['file']->store('public');
        $pathArray = explode('/', $path);

        $activity->records()->whereUserId(auth()->id())->first()->update([
            'file' => end($pathArray),
        ]);

        return back()->withSuccess('Project sumbmitted!');
    }

    public function submitAnswer(Request $request, Activity $activity)
    {
        $record = $this->getRecord($activity);

        if ($this->isExpired($record, $activity)) {
            return abort(401);
        }
        $score = 0;
        if (is_null($request->ques)) {
            return redirect('/home')->withSuccess('Something went wrong');
        }
        foreach ($request->ques as $q) {
            $question = Question::find($q);
            if (array_key_exists($q, $request->ans) && $question->correct_answer === $request->ans[$q]) {
                $score ++;
            }
        }
        $rate = $score . "/" . count(request()->ques);
        $record->update(['score' => $rate]);
        return view('activity.done', compact('record', 'activity'));
    }
}