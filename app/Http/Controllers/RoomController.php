<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{
    public function joinRoom(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        $room = Room::whereName($data['name'])->first();

        if (!$room) {
            return response(['message' => 'room not found.'], 404);
        }

        if (!Hash::check($data['code'], $room->code)) {
            return response(['message' => 'wrong code. please contact your instructor'], 400);
        }
        $room->load(['lectures', 'user']); // get all lectures
        return $room;
    }
}
