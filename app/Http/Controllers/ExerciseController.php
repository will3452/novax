<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(Request $request) {

        $filters = [];

        if ($request->has('type') && $request->type != '') {
            $filters['type'] = $request->type;
        }

        $scaleFilter = auth()->user()->records()->latest()->first()->scale;

        $exercises = Exercise::whereScale($scaleFilter)->where($filters)->get();
        return view('exercises.index', compact('exercises'));
    }
}
