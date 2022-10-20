<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registrationPage()
    {
        $showRegistration = nova_get_setting('show_registration', false);

        if (! $showRegistration) return abort(404);
        return view('auth.register');
    }

    public function postRegister()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|unique:users,phone',
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['type'] = User::TYPE_BASIC;
        $user = User::create($data);
        return back()->withSuccess('success');
    }
}
