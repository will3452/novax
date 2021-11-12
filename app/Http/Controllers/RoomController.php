<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function show(ClassRoom $room)
    {
        return view('classroom.show', compact('room'));
    }
}
