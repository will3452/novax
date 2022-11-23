<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Pregnant;
use Illuminate\Http\Request;

class PregnantController extends Controller
{
    public function index (Request $request) {
        $pregnants = Pregnant::with(['profile'])->get();
        return view('pregnants.index', compact('pregnants'));
    }

    public function create(Request $request) {
        $profiles = Profile::whereSex('Female')->get();
        return view('pregnants.create', compact('profiles'));
    }

    public function store (Request $request) {
        $data = $request->validate([
            'lmp' => '',
            'edc' => '',
            'gp' => '',
            'wt' => '',
            'bp' => '',
            'husband' => '',
            'profile_id' => ['required', 'exists:profiles,id']
        ]);

        Pregnant::create($data);

        alert()->success('Record has been added!');

        return back();
    }

    public function show(Request $request, Pregnant $pregnant) {
        $pregnant->load('profile');
        return view('pregnants.show', compact('pregnant'));
    }

    public function edit(Request $request, Pregnant $pregnant) {
        $profiles = Profile::whereSex('Female')->get();
        return view('pregnants.update', compact('pregnant', 'profiles'));
    }

    public function update(Request $request, Pregnant $pregnant)
    {
        $data = $request->validate([
            'lmp' => '',
            'edc' => '',
            'gp' => '',
            'wt' => '',
            'bp' => '',
            'husband' => '',
            'profile_id' => ['required', 'exists:profiles,id']
        ]);

        $pregnant->update($data);

        alert()->success('Record has been updated!');

        return back();
    }
}
