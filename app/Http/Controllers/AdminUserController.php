<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
        'name' => 'required',
            'email' => ['required', 'unique:users,email', 'email'],
            'number' => ['required'],
            'level' => 'required',
            'strand' => 'required',
            'type' => 'required'
        ]);

        User::create($data);
        return back()->withSuccess('Created!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
                'email' => ['required', 'unique:users,email,'.$user->id, 'email'],
                'number' => ['required'],
                'level' => 'required',
                'strand' => 'required',
                'type' => 'required'
        ]);

        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password); //encrypt password
        }
        $user->update($data);
        return back()->withSuccess('changes saved!');
    }
}
