<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request, User $user) {
        $programs = Program::get();
        return view('profile', compact('user', 'programs'));
    }

    public function saveAccount(Request $request, User $user) {
        if ( $request->has('currentPassword') && $request->currentPassword != '') {
            if (Hash::check($request->currentPassword, $user->password)) {
                $password = bcrypt($request->newPassword);
                $user->update(['password' => $password]);
            } else {
                alert()->warning('Wrong password');
                return back();
            }
        }

        $user->update(['birthdate' => $request->birthdate]);


        alert()->success('Account has been updated!');

        return back();
    }

    public function savePreference(Request $request, User $user) {
        $data = $request->validate([
            'program_id' => ['required'],
            'workout_reminder' => ['required']
        ]);

        $user->update($data);

        alert()->success('Preference has been updated!');

        return back();
    }
}
