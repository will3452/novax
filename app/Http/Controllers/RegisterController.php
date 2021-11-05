<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function store()
    {
        $data = request()->validate([
            'email'=>'required|unique:users,email',
            'password'=>'required|min:8',
            'name'=>'required',
            'phone_number'=>'required',
            'address'=>'required'
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return view('success_register');
    }
}
