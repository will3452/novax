<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SubjectController extends Controller
{
    public function show(Subject $subject)
    {
        $userId = auth()->id();
        if (request()->has('student')) {
            $userId = request()->student;
            $room = User::find($userId)->classRoom->room;
        } else if (auth()->user()->type == User::TYPE_STUDENT) {
            $room = User::find($userId)->classRoom->room;
        } else {
            $room = User::find(auth()->id())->room;
        }

        $feedbacks = Feedback::whereSubjectId($subject->id)->whereNull('reply_to_feedback_id')->latest()->get()->groupBy(function ($e) {
            return $e->created_at->format('m-d-y');
        });

        return view('subject.show', compact('subject', 'userId', 'room', 'feedbacks'));
    }
}
