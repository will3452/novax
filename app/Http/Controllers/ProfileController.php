<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index (Request $request) {
        $profiles = Profile::get();

        return view('profiles.index', compact('profiles'));
    }

    public function create(Request $request) {
        return view('profiles.create');
    }

    public function show(Request $request, Profile $profile) {
        return view('profiles.show', compact('profile'));
    }

    public function edit(Request $request, Profile $profile) {
        return view('profiles.update', compact('profile'));
    }

    public function update(Request $request, Profile $profile) {
        $data = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'sex' => ['required'],
            'middle_name' => '',
            'smoker' => ['required'],
            'alcohol_drinker' => ['required'],
            'hypertension' => ['required'],
            'diabetes' => ['required'],
            'pwd' => ['required'],
            'phic_membership' =>'',
            'birthdate' => ['required'],
            'purok' => ['required'],
            'religion' => ['required'],
            'civil_status' => ['required'],
            'education_attainment' =>'',
            'occupation' => '',
            'cpno' => ['required', 'max:11'],
        ]);
        $profile->update($data);

        alert()->success('Profile has been updated!');

        return back();
    }


    public function store (Request $request) {
        $data = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'sex' => ['required'],
            'middle_name' => '',
            'smoker' => ['required'],
            'alcohol_drinker' => ['required'],
            'hypertension' => ['required'],
            'diabetes' => ['required'],
            'pwd' => ['required'],
            'phic_membership' =>'',
            'birthdate' => ['required'],
            'purok' => ['required'],
            'religion' => ['required'],
            'civil_status' => ['required'],
            'education_attainment' =>'',
            'occupation' => '',
            'cpno' => ['required', 'max:11'],
        ]);

        Profile::create($data);

        alert()->success('Profile has been added!');

        return back();
    }
}
