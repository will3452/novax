<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile(User $user)
    {
        return view('profile', compact('user'));
    }

    public function updatePicture(User $user)
    {
        $data = request()->validate([
            'picture' => 'required',
        ]);

        $data['picture'] = $data['picture']->store('public');

        Profile::updateOrCreate(['user_id' => $user->id], $data);
        return back();
    }

    public function saveProfile(User $user)
    {
        $data = request()->validate([
            'about' => ''
        ]);

        Profile::updateOrCreate(['user_id' => $user->id], $data);
        return response([], 200);
    }
}
