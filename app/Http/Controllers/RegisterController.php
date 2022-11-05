<?php

namespace App\Http\Controllers;

use App\Mail\VerifyYourAccount;
use App\Models\UnVerifiedUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'password' => 'required|confirmed|min:6'
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = UnVerifiedUser::create($data);
        Mail::to($data['email'])->send(new VerifyYourAccount($user));
        return back()->withSuccess('We\'ve sent you verification link please check your register email.');
    }
}
