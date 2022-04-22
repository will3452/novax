<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordResetLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function enterEmail()
    {
        return view('password.email');
    }

    public function requestPasswordResetLink(Request $request)
    {
        $data = $request->validate([
            'email' => ['email', 'required', 'exists:users,email'],
        ]);

        $user = User::whereEmail($data['email'])->first();

        $passwordResetLink = PasswordResetLink::create(['user_id' => $user->id, 'uuid' => Str::random(32)]);

        Mail::to($user)->send(new \App\Mail\PasswordResetLink($passwordResetLink));

        return back()->withSuccess('Password Reset link has been sent to your email!');
    }

    public function showPasswordReset(Request $request, PasswordResetLink $passwordResetLink)
    {
        return view('password.reset-form', compact('passwordResetLink'));
    }

    public function resetPassword(Request $request, PasswordResetLink $passwordResetLink)
    {
        $data = $request->validate([
            'password' => ['confirmed', 'required'],
        ]);
        $userId = $passwordResetLink->user_id;
        $user = User::find($userId);


        $passwordResetLink->user()->update(['password' => bcrypt($data['password'])]);
        PasswordResetLink::whereUserId($userId)->get()->each(fn ($e) => $e->delete()); // delete all password rest link generated
        Auth::login($user);
        return redirect('/home')->withSuccess('Welcome ! your password has been updated!');
    }
}
