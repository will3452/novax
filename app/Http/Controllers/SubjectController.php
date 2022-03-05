<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function show(Subject $subject)
    {
        $userId = auth()->id();
        if (request()->has('student')) {
            $userId = request()->student;
        }
        return view('subject.show', compact('subject', 'userId'));
    }
}
