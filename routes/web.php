<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    });

    // booking steps
    Route::get('/booking', function () {
        return Inertia::render('BookingForm');
    });

    Route::get('/notifications', function () {
        return Inertia::render('Notifications');
    });
});

Route::get('/login', function () {
    return Inertia::render('Login');
});

Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => ['email', 'exists:users,email', 'required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($data)) {
        return redirect('/dashboard');
    }

    return back()->withErrors(['authentication' => 'Your email/password does not match to our record.']);
});

// Route::get('/register', function () {
//     return Inertia::render('Register');
// });

Route::get('/', function () {
    return 'U-VAN EXPRESS';
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
