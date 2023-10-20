<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registrationPage()
    {
        return view('auth.register');
    }

    public function postRegister()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return back()->withSuccess('success');
    }

    public function routing($lat, $lng)
    {
        return view('routes', compact('lat', 'lng'));
    }
}
