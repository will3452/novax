<?php

use App\Models\Reservation;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\VehicleRequestForm;
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

Route::get('/form-request/{user}', function (Request $request, App\Models\User $user) {
   $vehicles = Vehicle::where('is_available', true)->get();
   return view('form-request', compact('user', 'vehicles'));
});

Route::get('/trips/{user}', function (Request $request, App\Models\User $user) {
    $trips = Trip::latest()->get();
    return view('trips', compact('trips', 'user'));
});

Route::get('/reserve/{user}/{trip}', function (Request $request, \App\Models\User $user, \App\Models\Trip $trip) {
    return view('reserve', compact('trip', 'user'));
});

Route::get('/map/{trip}', function (Request $request, Trip $trip) {
    return view('map', compact('trip'));
});

Route::get('/mobile-landing', function (Request $request) {
    return view('mobile-landing');
});

Route::get('/default-map', function (Request $request) {
    return view('default-map');
});

Route::get('/schedule/{user}', function (Request $request, User $user) {
    $type = $request->type;
    $profile = ("\\App\\Models\\$type")::whereUserId($user->id)->first();
    $param = $type == 'Driver' ? 'driver_id' : 'client_id';
    $reservations = Reservation::whereStatus('Approved')->where([$param => $profile->id])->get();
    return view('schedule', compact('user', 'profile', 'reservations'));
});

Route::get('/chat/{user}/{otherUser}', function (Request $request, User $user, User $otherUser) {
    return view('chat', compact('user', 'otherUser'));
});

Route::get('/inbox/{user}', function (Request $request, User $user) {
    return view('inbox', compact('user'));
});

Route::post('/reserve', function (Request $request) {
    $user = User::find($request->user_id);
    $trip = Trip::find($request->trip_id);
    $driver_id = $trip->vehicle->driver_id;
    // dd($request->all());
    Reservation::create([
        'client_id' => $user->client ? $user->client->id : 1,
        'driver_id' => $driver_id,
        'trip_id' => $request->trip_id,
        'date' => $request->date,
        'status' => 'For Approval',
    ]);

    return view('success');
});

Route::post('/form-request', function (Request $request) {
    $remarks = "<ul>";
    for($i = 0; $i < 5; $i++) {
        $p = $request->passenger[$i];
        $o = $request->organization[$i];
        $d = $request->destination[$i];
        $remarks .= "<li>$p - $o - $d</li>";
    }

    $remarks .= "</ul>";

    $tr = $request->file('request_travel')->store('public');
    $trArr = explode("/", $tr);
    $tr = end($trArr);
    $to = $request->file('travel_order')->store('public');
    $toArr = explode("/", $to);
    $to = end($toArr);

    VehicleRequestForm::create([
        'user_id' => $request->user_id,
        'model' => implode(",", $request->model),
        'purpose' => $request->purpose,
        'remarks' => $remarks,
        'request_travel' => $tr,
        'travel_order' => $to,
        'date' => $request->date,
        'status' => $request->status ?? 'approved',
    ]);

    return view('success');
});
