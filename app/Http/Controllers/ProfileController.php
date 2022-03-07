<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function profile()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|max:11',
            'password' => 'required|min:6',
            'address' => 'required',
        ]);

        $data['password'] = bcrypt($data['password']);

        auth()->user()->update($data);

        return back()->withSuccess('Profile updated!');
    }
}
