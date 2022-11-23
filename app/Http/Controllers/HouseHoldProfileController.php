<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\FamilyHouseholdProfile;

class HouseHoldProfileController extends Controller
{
    public function index (Request $request) {
        $hh = FamilyHouseholdProfile::get();
        return view('hh.index', compact('hh'));
    }

    public function create (Request $request) {
        return view('hh.create');
    }

    public function store (Request $request) {
        $data = $request->validate([
            'four_ps' => ['required'],
            'purok' => ['required'],
            'nhts' => ['required'],
            'dialect' => ['required'],
            'type_of_dwelling' => ['required'],
            'type_of_electricity' => ['required'],
            'source_of_water' => ['required'],
            'sanitation_facilities' => ['required'],
        ]);

        FamilyHouseholdProfile::create($data);

        alert()->success('Record has been added!');

        return back();
    }

    public function show (Request $request, FamilyHouseholdProfile $hh) {
        $profiles = Profile::wherePurok($hh->purok)->whereNotIn('id', $hh->profiles->pluck('id'))->get();
        return view('hh.show', compact('hh', 'profiles'));
    }

    public function edit(Request $request, FamilyHouseholdProfile $hh) {
        return view('hh.update', compact('hh'));
    }

    public function update(Request $request, FamilyHouseholdProfile $hh) {

        $data = $request->validate([
            'four_ps' => ['required'],
            'purok' => ['required'],
            'nhts' => ['required'],
            'dialect' => ['required'],
            'type_of_dwelling' => ['required'],
            'type_of_electricity' => ['required'],
            'source_of_water' => ['required'],
            'sanitation_facilities' => ['required'],
        ]);

        $hh->update($data);

        alert()->success('Record has been updated!');

        return back();
    }

    public function toggleProfile(Request $request, FamilyHouseholdProfile $hh) {
        $data = $request->validate([
            'profile_id' => ['required'],
        ]);

        $hh->profiles()->toggle($data['profile_id']);

        alert()->success('Action Success!');

        return back();
    }
}
