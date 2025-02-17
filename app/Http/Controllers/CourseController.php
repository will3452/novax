<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index () {
        return view('course.index');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required'],
            'code' => ['required'],
            'thesis_phase' => ['required'],
        ]);

        Course::create($data);

        return back()->withSuccess('Course has been created!');
    }
}
