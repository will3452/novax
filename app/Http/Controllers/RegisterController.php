<?php

namespace App\Http\Controllers;

use App\Models\Aan;
use App\Rules\ValidAan;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registerScholar()
    {
        return view('register_scholar');
    }

    public function registerScholarPost()
    {
        $validated = request()->validate(
            [
                'aan' => ['required', new ValidAan],
                'first_name' => 'required',
                'last_name' => 'required',
                'user_name' => ['required', 'unique:users,user_name'],
                'gender' => 'required',
                'sex' => 'required',
                'address' => 'required',
                'country' => 'required',
                'city' => 'required',
                'birth_date' => 'required',
                'email' => ['required', 'unique:users,email'],
                'password' => ['required', 'confirmed', 'min:6'],
                'college' => 'required',
                'course' => 'required',
                'club' => 'required',
                'picture' => ['required', 'image', 'max:5000']
            ]
        );

        //save picture
        $validated['picture'] = FileHelper::save(request()->picture);

        unset($aan);

        return $validated;

    }
}
