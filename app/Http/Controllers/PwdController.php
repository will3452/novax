<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Pwd;
use Illuminate\Http\Request;

class PwdController extends Controller
{
    public function index (Request $request) {
        $pwds = Pwd::get();

        return view('pwds.index', compact('pwds'));
    }

    public function create(Request $request) {
        return view('pwds.create', ['profiles' => Profile::get()]);
    }

    public function show(Request $request, Pwd $pwd) {
        return view('pwds.show', compact('pwd'));
    }

    public function edit(Request $request, Pwd $pwd) {
        $profiles =  Profile::get();
        return view('pwds.update', compact('pwd', 'profiles'));
    }

    public function update(Request $request, Pwd $pwd) {
        $data = $request->validate([
            'type_of_disability' => ['required'],
            'pwd_id' => ['required'],
            'profile_id' => ['required'],
            'remarks' => '',
        ]);

        $pwd->update($data);

        alert()->success('pwd has been updated!');

        return back();
    }


    public function store (Request $request) {
        $data = $request->validate([
            'type_of_disability' => ['required'],
            'pwd_id' => ['required'],
            'profile_id' => ['required'],
            'remarks' => '',
        ]);

        Pwd::create($data);

        alert()->success('pwd has been added!');

        return back();
    }
}
