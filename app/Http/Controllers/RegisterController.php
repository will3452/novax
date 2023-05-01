<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
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
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'suffix' => '',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'sex' => ['required'],
            'address' => ['required'],
            'birthdate' => ['required'],
            'contact_no' => ['required', 'max:11'],
            'valid_id' => 'required|image|mimes:jpeg,png|max:2048',
        ]);

        $path = $data['valid_id']->store('public');

        $pathArray = explode('/', $path);

        $data['valid_id'] = end($pathArray);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        Mail::to($user)->send(new EmailVerification($user));
        return "Thank you for signing up for our service. To complete your registration, please click on the verification link we have sent to your email address. If you have not received the email, please check your spam or junk folder.";
    }
}
