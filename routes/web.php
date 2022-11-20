<?php

use Carbon\Carbon;
use App\Models\Bus;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register', [RegisterController::class, 'registrationPage']);
// Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
Route::get('/logout', function () {
    auth()->user()->update(['lat_lng' => null]);
    auth()->logout();
    return redirect()->to('/');
});

Route::prefix('bookings')->name('bookings.')->middleware(['auth'])->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');

Route::post('/cancel', [BookingController::class, 'cancelBooking'])->name('cancel');
});

Route::prefix('notices')->name('notices.')->middleware(['auth'])->group(function () {
    Route::get('/', [NoticeController::class, 'index']);
});

Route::prefix('tickets')->name('tickets.')->middleware(['auth'])->group(function () {
    Route::get('/', [TicketController::class, 'index']);
    Route::get('/me', [TicketController::class, 'getTickets']);
    Route::get('/{ticket}', [TicketController::class, 'getDetails']);
    Route::post('/{ticket}', [TicketController::class, 'markAsUsed']);
});

Route::get('/notifications', function () {
    return view('notifications');
});

Route::get('/map', function () {
    return view('map');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth']);

Route::post('/profile', function (Request $request) {
    $data = $request->validate([
        'name' => "required",
        'mobile' => 'required',
        'password' => ['password', 'min:8', 'confirmed'],
    ]);
    $data['password'] = bcrypt($request->password);
    User::find(auth()->id())->update($data);
    return back()->withSuccess(1);
});

Route::get('/schedules', function () {
    $bus = Bus::with(['trip', 'time'])->get();
    foreach ($bus as $d) {
        $d['trips'] = $d->trip->start . ' - ' . $d->trip->end;
        $d['timex'] = Carbon::parse($d->time->time)->format('H:i a');
    }
    return view('schedules', ['bus' => $bus]);
});


Route::post('pay', [PaymentController::class, 'pay']);
Route::get('/pay/{booking}', [PaymentController::class, 'choosePay']);

Route::prefix('scan')->name('scan.')->middleware(['auth'])->group(function () {
    Route::get('/', [ScanController::class, 'scan'])->name('index');
});

// paypal
Route::get('/paypal/{booking}', function (Request $request, Booking $booking) {
    try {
        $hashed = $request->hashed;
        $value = $request->value;
        if (! Hash::check($value, $hashed)) {
            return 'Invalid request';
        }
        $booking->booked();
        return redirect()->to('/bookings');
    } catch (Exception $error) {
        return $error->getMessage();
    }
});
