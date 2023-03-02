<?php

namespace App\Http\Controllers;

use App\Models\HeadOfTheFamily;
use App\Models\Profile;
use Illuminate\Http\Request;

class HeadOfTheFamilyController extends Controller
{
    public function index (Request $request) {
        $headOfTheFamilies = HeadOfTheFamily::with(['profile'])->get();
        return view('head-of-the-family.index', compact('headOfTheFamilies'));
    }

    public function create(Request $request) {
        $profiles = Profile::whereSex('Male')->get();
        return view('head-of-the-family.create', compact('profiles'));
    }

    public function store (Request $request) {
        $data = $request->validate([
            'profile_id' => ['required', 'exists:profiles,id']
        ]);

        HeadOfTheFamily::create($data);

        alert()->success('Record has been added!');

        return back();
    }

    public function show(Request $request, HeadOfTheFamily $headOfTheFamily) {
        $headOfTheFamily->load('profile');
        return view('head-of-the-family.show', compact('headOfTheFamily'));
    }

    public function edit(Request $request, HeadOfTheFamily $pregnant) {
        $profiles = Profile::whereSex('Male')->get();
        return view('head-of-the-family.update', compact('pregnant', 'profiles'));
    }

    public function update(Request $request, HeadOfTheFamily $pregnant)
    {
        $data = $request->validate([
            'profile_id' => ['required', 'exists:profiles,id']
        ]);

        $pregnant->update($data);

        alert()->success('Record has been updated!');

        return back();
    }
}
