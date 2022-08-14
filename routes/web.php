<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketController;
use App\Models\User;
use Illuminate\Http\Request;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
Route::get('/logout', function () {
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

Route::post('pay', [PaymentController::class, 'pay']);
