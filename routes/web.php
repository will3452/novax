<?php

use App\Models\Booking;
use App\Models\User;
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

    Route::post('/booking', function (Request $request) {
        $request->validate([
            'driver' => ['required'],
            'fee' => ['required'],
            'distance' => ['required'],
        ]);

        $data = [
            'client_id' => auth()->id(),
            'server_id' => $request->driverId,
            'amount' => $request->fee,
            'from_address' => $request->steps[0]['address'],
            'from_lat' => $request->steps[0]['lat'],
            'from_lng' => $request->steps[0]['lng'],
            'to_address' => $request->steps[0]['address'],
            'to_lat' => $request->steps[0]['lat'],
            'to_lng' => $request->steps[0]['lng'],
            'landmark' => '---',
            'mop' => 'CASH',
            'status' => 'PENDING',
        ];

        Booking::create($data);
        Inertia::share('message', fn() => "Your booking request has been sent to the selected provider. the system will notify you once your request approved.");
        return redirect()->to('/dashboard');
    });

    Route::get('/notifications', function () {
        return Inertia::render('Notifications');
    });
});

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login')->middleware(['guest']);

Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => ['email', 'exists:users,email', 'required'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($data)) {
        return back()->withErrors(['authentication' => 'Your email/password does not match to our record.']);
    }
    return Inertia::render('Dashboard');
});

Route::get('/register', function () {
    return Inertia::render('Register');
});

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'email' => ['email', 'unique:users,email', 'required'],
        'password' => ['required'],
        'name' => ['required'],
    ]);

    $data['password'] = bcrypt($data['password']);
    $user = User::create($data);

    // login with id
    Auth::loginUsingId($user->id);

    return redirect('/dashboard');
});

Route::get('/', function () {
    return redirect()->to('/login');
});

// Route::get('/register', [RegisterController::class, 'registrationPage']);
// Route::post('/register', [RegisterController::class, 'postRegister']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
