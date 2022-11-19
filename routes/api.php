<?php

use App\Models\Trip;
use App\Models\User;
use App\Models\Notice;
use App\Models\Discount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FileImageController;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Time;
use App\Notifications\PaymentStatusUpdate;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function () {
        return 'authentication test';
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/get-user-details', function (Request $request) {
    return User::find($request->user);
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::get('/latest-notices', function (Request $req) {
    $limit = $req->limit ?? 0;
    if ($limit == 0) {
        $notices = Notice::latest()->get();
        return $notices;
    }
    $notices = Notice::latest()->take($limit)->get();
    return $notices;
});

// trip
Route::get('/trips', function (Request $req) {
    $trip = Trip::get(); // get all trip
    return $trip;
});

// notifications
Route::get('/notifications', function (Request $request) {
    $user = User::find($request->user);
    return $user->notifications;
});

//payment option - gcash pkey
Route::get('/pkey', function () {
    return config('payment.gcash_pkey');
});

Route::get('/webhook-link', function () {
    $uri = config('payment.gcash_webhook');
    return url($uri);
});

Route::post('/payment/webhook', function (Request $request) {
    $payload = $request->all();
    $verified = $request->success;
    $txn = Transaction::whereHash($request->request_id)->first();
    $txn->update(['verified' => $verified, 'aggregate_payload' => json_encode($payload)]);
    $user = $txn->model->user;
    Notification::send($user, new PaymentStatusUpdate($txn)); //send notif
    if ($verified) {
        $txn->model->booked(json_encode($payload));
    }
});

Route::get('/conductors', function (Request $request) {
    return User::whereNotNull('lat_lng')->whereType(User::TYPE_CONDUCTOR)->get();
});

//transactions
Route::post('/transaction', function (Request $request) {
    $data = $request->validate([
        'hash' => 'required',
        'model_type' => 'required',
        'model_id' => 'required',
    ]);

    $transaction = Transaction::create($data);

    return $transaction;
});

//discounts
Route::get('/discounts', fn (Request $request) => Discount::get());


Route::post('/fetch-bus', [BookingController::class, 'fetchBus']);

Route::get('/times', fn (Request $request) => Time::get());

Route::post('/file-image-upload', [FileImageController::class, 'upload']);
Route::post('/file-image-remove', [FileImageController::class, 'remove']);

Route::post('/booking', [BookingController::class, 'store']);
Route::get('/booking', [BookingController::class, 'getUserBookings']);
Route::post('/user-location-update', function (Request $request) {
    return User::find($request->user)->update(['lat_lng' => $request->lat_lng]);
});
