<?php

namespace App\Http\Controllers;

use App\Rules\AgeMustBe21;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function profile (){
        return view('profile');
    }
    public function updateProfile(Request $request) {
         $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['required', new AgeMustBe21],
            'gender' => ['required'],
        ]);
        toast('Profile updated!');
        auth()->user()->update($data);
        return back();
    }
}
