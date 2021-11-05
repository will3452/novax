<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function store()
    {
        $validated = request()->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        if(Auth::attempt($validated)){
            return redirect('/');
        }

        return back()->withError('Account Not Found!');
    }
}
