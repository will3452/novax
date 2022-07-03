<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index (Request $request) {
        $keyword = '';
        if ($request->has('keyword')) {
            $keyword = $request->keyword;
        }
        return view('exercises.index', ['exercises' => Exercise::where('name', 'LIKE', "%$keyword%")->latest()->take(10)->get()]);
    }

    public function show(Request $request, Exercise $e) {
        return view('exercises.show', compact('e'));
    }
}
