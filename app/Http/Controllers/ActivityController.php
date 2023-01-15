<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index (Request $request) {
        $activities = auth()->user()->activities()->latest()->get();
        return view('progress.index', compact('activities'));
    }
    public function addActivity(Request $request) {
        $data = ['user_id' => auth()->id()];

        if ($request->has('meal_id')) {
            $data['meal_id'] = $request->meal_id;
        }

        if ($request->has('exercise_id')) {
            $data['exercise_id'] = $request->exercise_id;
        }

        $existing = Activity::whereDate('created_at', now())->where($data)->exists();

        alert()->success('Activity has been logged.');

        if (! $existing) {
            Activity::create($data);
        }

        return back();
    }
}
