<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Nova;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function postLogin()
    {
        $data = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::whereEmail($data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);
            if ($user->type === User::TYPE_SEEKER) {
                return redirect('/dashboard');
                dd($user);
            }

            return redirect(Nova::path());
        }

        return back()->WithErrors(['email'=>'Wrong Credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }
}
