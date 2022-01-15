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
            'valid_id' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        $path = request()->valid_id->store('public');

        $data['valid_id'] = str_replace('public', '', $path);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return back()->withSuccess('success');
    }
}
