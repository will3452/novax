<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['email', 'required', 'exists:users,email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($data)) {
            return redirect(RouteServiceProvider::HOME);
        }

        return back()->withErrors('Wrong email or password!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/login');
    }
}
