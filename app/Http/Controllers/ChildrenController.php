<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Children;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function index (Request $request) {
        $children = Children::with(['mother', 'child'])->get();
        return view('children.index', compact('children'));
    }

    public function create (Request $request) {
        $profiles = Profile::get();
        $mothers = Profile::whereSex('Female')->get();
        return view('children.create', compact('profiles', 'mothers'));
    }

    public function edit (Request $request, Children $children) {
        $profiles = Profile::get();
        $mothers = Profile::whereSex('Female')->get();
        return view('children.update', compact('profiles', 'mothers', 'children'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'child_profile_id' => 'required',
            'mother_profile_id' => 'required',
            'wt' => 'required',
        ]);

        if ($data['mother_profile_id'] == $data['child_profile_id']) {
            alert()->error('Invalid inputs');

            return back();
        }

        Children::create($data);
        alert()->success('Record has been added!');
        return back();
    }

    public function update(Request $request, Children $children) {
        $data = $request->validate([
            'child_profile_id' => 'required',
            'mother_profile_id' => 'required',
            'wt' => 'required',
        ]);

        if ($data['mother_profile_id'] == $data['child_profile_id']) {
            alert()->error('Invalid inputs');

            return back();
        }

        $children->update($data);
        alert()->success('Record has been updated!');
        return back();
    }

    public function show(Request $request, Children $children) {
        return view('children.show', compact('children'));
    }
}
