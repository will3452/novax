<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('profile');
    }

    public function updateProfile()
    {
        $data = request()->validate([
            'name'=>'required',
            'password'=>'',
            'phone_number'=>'',
            'address'=>''
        ]);

        $data['password'] = bcrypt($data['password']);

        auth()->user()->update($data);

        return back()->withSuccess('Success!');
    }
}
