<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Controllers\LoginController as ControllersLoginController;

class LoginController extends ControllersLoginController
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

        return back()->withError('Wrong email or password!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/login');
    }
}
