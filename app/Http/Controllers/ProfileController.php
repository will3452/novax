<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateProfile (Request $request, Profile $profile) {
        return view('profile');
    }

    public function saveFile($file) {
        try {
            $path = $file->store('public');
            $arrPath = explode('/', $path);

            return end($arrPath);
        } catch (Exceptions $e) {
            return "";
        }
    }

    public function updateProfilePost(Request $request) {
        $data = $request->validate([
            'educational_level' => ['required'],
            'monthly_salary' => ['required'],
            'address' => ['required'],
            'id_1' => ['image', 'max:5000'],
            'id_2' => ['image', 'max:5000'],
            'mothers_name' => ['required'],
            'fathers_name' => ['required'],
            'work' => ['required'],
            'company' => ['required'],
            'school' => ['required'],
            'password' => ['confirmed', 'password', 'min:8', 'required'],
            'company' => ''
        ]);

        //save file
        $data['id_1'] = $this->saveFile($request->id_1);
        $data['id_2'] = $this->saveFile($request->id_2);

        $userUpdateData = [];

        if ($request->has('name')) {
            $userUpdateData['name'] = $request->name;
        }

        if ($request->has('password')) {
            $userUpdateData['password'] = bcrypt($request->password);
        }
        auth()->user()->update($userUpdateData);
        Profile::updateOrCreate(['user_id' => auth()->id()], $data);

        return back()->withSuccess(true);
    }
}
