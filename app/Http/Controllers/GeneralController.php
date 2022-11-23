<?php

namespace App\Http\Controllers;

use App\Models\General;
use App\Models\Profile;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index (Request $request) {
        $generals = General::get();
        return view('generals.index', compact('generals'));
    }

    public function create (Request $request) {
        $profiles = Profile::get();
        return view('generals.create', compact('profiles'));
    }

    public function store (Request $request) {
        $data = $request->validate([
            'temp' => '',
            'bp' => '',
            'hr' => '',
            'pr' => '',
            'o2_level' => '',
            'chief_complaint' => '',
            'treatment_management' => '',
            'profile_id' => ['required', 'exists:profiles,id']
        ]);

        General::create($data);

        alert()->success('Record has been added!');

        return back();
    }

    public function show (Request $request, General $general) {

        return view('generals.show', compact('general'));
    }

    public function edit(Request $request, General $general) {
        $profiles = Profile::get();
        return view('generals.update', compact('general', 'profiles'));
    }

    public function update(Request $request, General $general) {
        $data = $request->validate([
            'temp' => '',
            'bp' => '',
            'hr' => '',
            'pr' => '',
            'o2_level' => '',
            'chief_complaint' => '',
            'treatment_management' => '',
            'profile_id' => ['required', 'exists:profiles,id']
        ]);

        $general->update($data);

        alert()->success('Record has been updated!');

        return back();
    }
}
