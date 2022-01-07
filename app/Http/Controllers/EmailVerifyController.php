<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerificationLink;
use Illuminate\Support\Facades\Mail;

class EmailVerifyController extends Controller
{
    public function sendVerification()
    {
        Mail::to(auth()->user()->email)->send(new EmailVerificationLink(auth()->user()));
        return response([], 200);
    }

    public function verifyEmail(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        User::findOrFail($request->user)->update([
            'email_verified_at' => now(),
        ]);

        return view('email-result');
    }
}
