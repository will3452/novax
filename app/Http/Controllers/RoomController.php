<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function teacherRoom()
    {
        $room = auth()->user()->room;
        return view('teacher.room', compact('room'));
    }

    public function studentRoom(Request $request)
    {
        $room = null;
        $user = auth()->user();

        if ($request->has('student')) {
            $user = User::findOrFail($request->student);
            $room = $user->classRoom->room;
        } else {
            $room = auth()->user()->classRoom->room;
        }
        return view('student.room', compact('room', 'user'));
    }
}
