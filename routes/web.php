<?php

use App\Models\Booking;
use App\Models\Code;
use App\Models\Feedback;
use App\Models\User;
use App\Notifications\BookingUpdateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Inertia;

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    });

    // approve bookings
    Route::post('/approve/{booking}', function (Request $request, Booking $booking) {
        $booking->update(['status' => 'APPROVED']);
        User::find($booking->client_id)->notify(new BookingUpdateNotification('Approved'));
        return redirect()->to('/dashboard');
    });
    Route::post('/reject/{booking}', function (Request $request, Booking $booking) {
        $booking->update(['status' => 'REJECTED']);
        User::find($booking->client_id)->notify(new BookingUpdateNotification('Rejected'));
        return redirect()->to('/dashboard');
    });

    // booking steps
    Route::get('/booking', function () {
        return Inertia::render('BookingForm');
    });

    Route::post('/feedback', function (Request $request) {
        $data = $request->validate([
            'message' => 'required',
            'driver_id' => 'required',
            'booking_id' => 'required',
            'star' => 'required',
        ]);

        $data['user_id'] = auth()->id();

        Feedback::create($data);

        return redirect()->to('/booking');
    });

    Route::get('/bookings', function () {
        $isDriver = auth()->user()->type == User::TYPE_DRIVER;

        $bookings = [];

        if ($isDriver) {
            $bookings = Booking::with('feedback')->whereServerId(auth()->id())->latest()->get();
        } else {
            $bookings = Booking::with(['feedback', 'server'])->whereClientId(auth()->id())->latest()->get();
        }
        return Inertia::render('Bookings', compact('bookings'));
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
            'to_address' => $request->steps[1]['address'],
            'to_lat' => $request->steps[1]['lat'],
            'to_lng' => $request->steps[1]['lng'],
            'landmark' => '---',
            'mop' => 'CASH',
            'status' => 'PENDING',
            'qty' => $request->qty,
        ];

        Booking::create($data);
        Inertia::share('message', fn() => "Your booking request has been sent to the selected provider. the system will notify you once your request approved.");
        return redirect()->to('/dashboard');
    });

    Route::get('/notifications', function () {
        $notifications = auth()->user()->notifications;
        return Inertia::render('Notifications', ['notifications' => $notifications]);
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

function sendCode($code, $number)
{
    $ch = curl_init();
    $parameters = array(
        'apikey' => '01840ce0776e706f416144346945588b', //Your API KEY
        'number' => $number,
        'message' => 'Your OTP code. ' . $code,
        'sendername' => 'SEMAPHORE',
    );
    curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
    curl_setopt($ch, CURLOPT_POST, 1);

//Send the parameters set above with the request
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

// Receive response from server
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);

//Show the server response
    echo $output;
}

Route::post('/verified', function (Request $request) {
    $data = $request->validate([
        'code' => 'required',
    ]);

    if ($data['code'] == auth()->user()->code) {
        auth()->user()->update(['code_verified' => 1]);
        return response(['message' => 'success'], 200);
    }

    return response(['message' => 'error'], 422);
});

Route::post('/send-otp', function (Request $request) {
    $code = Str::random(8);
    $number = $request->mobile;
    sendCode($code, $number);

    auth()->user()->update(['code' => $code]);

    return Code::create(['code' => $code, 'mobile' => $number]);
});

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'email' => ['email', 'unique:users,email', 'required'],
        'password' => ['required'],
        'name' => ['required'],
        'mobile' => ['required', 'max:11', 'min:11'],
    ]);

    $data['password'] = bcrypt($data['password']);

    $code = Str::random(8);
    $number = $request->mobile;
    sendCode($code, $number);

    $data['code'] = $code; 
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

Route::post('/location-update', function (Request $request) {
    return User::find($request->user_id)->update(['lat' => $request->lat, 'lng' => $request->lng]); 
}); 
