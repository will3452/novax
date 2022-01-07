<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function registrationPage()
    {
        return Inertia::render('Register');
    }

    public function postRegister()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return back()->withSuccess('success');
    }
}
