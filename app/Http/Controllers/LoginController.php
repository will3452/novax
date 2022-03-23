<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $r)
    {
        $data = $r->validate([
            'email' => ['required', 'exists:users,email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($data)) {
            return redirect('/home');
        }

        return back()->withAlert('Wrong creds!');
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
        }
        return redirect('/');
    }
}
