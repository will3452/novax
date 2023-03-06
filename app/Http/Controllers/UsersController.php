<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index (Request $request) {
        $users = User::get();

        return view('users.index', compact('users'));
    }

    public function create(Request $request) {
        return view('users.create');
    }

    public function show(Request $request, User $user) {
        return view('users.show', compact('user'));
    }

    public function edit(Request $request, User $user) {
        return view('users.update', compact('user'));
    }

    public function update(Request $request, User $user) {
        $data = $request->validate([
            'password' => '',
            'email' => ['required', 'email', 'exists:users,email'],
            'role' => ['required'],
        ]);

        if ($data['password'] == '') {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        alert()->success('User has been updated!');

        return back();
    }


    public function store (Request $request) {
        $data = $request->validate([
            'password' => ['required', 'min:6'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required'],
        ]);

        $data['password'] = bcrypt($data['password']);



        User::create($data);

        alert()->success('User has been added!');

        return back();
    }
}
