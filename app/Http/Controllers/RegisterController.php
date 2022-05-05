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

    public function employerRegistrationPage()
    {
        return view('auth.register-employer');
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

    public function postEmployerRegister(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'legal_document' => ['required', 'max:5000'],
        ]);

        $data['legal_document'] = $request->legal_document->store('public');
        $data['password'] = bcrypt($data['password']);
        $data['type'] = User::TYPE_EMPLOYER;
        $user = User::create($data);
        return back()->withSuccess('success');
    }
}
