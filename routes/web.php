<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    return redirect()->to(config('nova.path'));
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


Route::get('/verification-notice', function () {
    return view('auth.verify-notice');
})->name('verification.notice');

Route::post('/verification-send', function () {
    $user = auth()->user();
    // Logic to send verification code to the user
    // For example, create a verification code and email it to the user
    $code = rand(100000, 999999);
    \App\Models\VerificationCode::create([
        'user_id' => $user->id,
        'code' => $code,
        'expires_at' => now()->addMinutes(15),
    ]);
    // Here you would typically send the code via email

    return back()->with('status', 'Verification code sent!');
})->name('verification.send');

Route::post('/verification-verify', function () {
    $user = auth()->user();
    $inputCode = request()->verification_code;

    $verificationCode = \App\Models\VerificationCode::where('user_id', $user->id)
        ->where('code', $inputCode)
        ->where('expires_at', '>', now())
        ->first();

    if ($verificationCode) {
        // Mark user as verified
        $user->verified_at = now();
        $user->save();

        // Optionally, delete used verification codes
        \App\Models\VerificationCode::where('user_id', $user->id)->delete();

        return redirect()->intended('/')->with('status', 'Your account has been verified!');
    } else {
        return back()->withErrors(['code' => 'Invalid or expired verification code.']);
    }
})->name('verification.verify');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');
