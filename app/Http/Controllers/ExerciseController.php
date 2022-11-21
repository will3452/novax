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

        $exercises = Exercise::where($filters)->get();
        return view('exercises.index', compact('exercises'));
    }
}
