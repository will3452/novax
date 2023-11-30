<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/otp', function(Request $request) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }
    return view('vendor.nova.auth.otp'); 
})->name('otp'); 


Route::post('/otp-confirm', function (Request $request) {
    $otp = $request->otp; 
    $user = $request->user; 
    $c = $request->c; 

    if (! Hash::check($otp, $c)) {
        abort(401); 
    }

    auth()->loginUsingId($user); 
    return redirect('/admin/dashboards/main'); 
}); 

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => ['required', 'exists:users,email'],
        'password' => ['required'], 
    ]); 

    $user = User::whereEmail($request->email)->first();
    if (! Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Credentials does not match!']); 
    }

    $code = random_int(1234, 7899); 

    Mail::raw("Your OTP CODE is $code.", function ($message) use($user) {
        $message->to($user->email)->subject('OTP CODE'); 
    }); 
    $url = URL::temporarySignedRoute('otp', now()->addMinutes(30), ['user' => $user->id, 'c' => bcrypt($code), 'code' => $code]); 
    return redirect()->to($url);  
});
