<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|max:5000',
            'room_id' => 'required',
            'reply_to_feedback_id' => '',
        ]);

        auth()->user()->feedback()->create($data);

        return back()->withSuccess('Feedback submitted!');
    }
}
