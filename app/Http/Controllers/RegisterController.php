<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => '',
            'birthday' => 'required',
            'address' => 'required',
            'package_id' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['account_number'] = "AC" . rand();
        Client::create($data);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'type' => User::TYPE_CLIENT,
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        return back()->withSuccess('success');
    }
}
