
<?php

use App\Models\Trip;
use App\Models\User;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\Feedback;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\VehicleRequestForm;
use Illuminate\Support\Facades\Http;
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

Route::get('/new-request/{user}', function () {
    return view('new-request');
});

Route::post('/new-request', function (Request $request) {
    $address = $request->destination;
    $api = env('GEOAPI_KEY');
    $d_lat = '';
    $d_long = '';

    $f1 = explode("/", $request->file('request_travel')->store('public'));
    $f2 = explode("/", $request->file('travel_order')->store('public'));

    $travel_order = end($f1);
    $request_travel = end($f2);


    try {
        $response = Http::get("https://geocode.maps.co/search?q=$address&api_key=$api");
        $result = $response->json();
        $d_lat = $result[0]['lat'];
        $d_long = $result[0]['lon'];
    } catch( Exception $e) {

    }
    VehicleRequestForm::create([
        'user_id' => auth()->id(),
        'model' => $request->destination,
        'purpose' => $request->purpose,
        'date' => $request->date,
        'time' => $request->time,
        'remarks' => $request->passenger,
        'd_lat' => $d_lat,
        'd_long' => $d_long,
        'request_travel' => $request_travel,
        'travel_order' => $travel_order,
        'status' => 'pending',
    ]);

    alert()->success('Your request has been submitted!');
    return redirect()->to("/mobile-dashboard/" . auth()->id());
});

Route::get('/form-request/{user}', function (Request $request, App\Models\User $user) {
   $vehicles = Vehicle::where('is_available', true)->get();
   $record = VehicleRequestForm::whereUserId($user->id)->orderBy('date', 'desc')->get();
   if ($request->has('date')) {
    $record = VehicleRequestForm::whereUserId($user->id)->whereDate('date', $request->date)->orderBy('date', 'desc')->get();
   }
   return view('form-request', compact('user', 'vehicles', 'record'));
});

Route::get('/form-request-create/{user}', function (Request $request, App\Models\User $user) {
    $vehicles = Vehicle::where('is_available', true)->get();
    $record = VehicleRequestForm::whereUserId($user->id)->get();
    return view('form-request-create', compact('user', 'vehicles', 'record'));
});

Route::get('/view-request/{fr}', function (Request $request, VehicleRequestForm $fr) {
    $user = auth()->user();
    $vehicles = Vehicle::get();
    return view('form-request-print', compact('fr', 'user', 'vehicles'));
});
Route::get('/mobile-view-request/{fr}', function (Request $request, VehicleRequestForm $fr) {
    $user = auth()->user();
    $vehicles = Vehicle::get();
    return view('mobile-form-request-print', compact('fr', 'user', 'vehicles'));
});

Route::get('/trips/{user}', function (Request $request, App\Models\User $user) {
    $trips = Trip::latest()->get();
    return view('trips', compact('trips', 'user'));
});

Route::get('/reserve/{user}/{trip}', function (Request $request, \App\Models\User $user, \App\Models\Trip $trip) {
    return view('reserve', compact('trip', 'user'));
});

Route::get('/map/{trip}', function (Request $request, VehicleRequestForm $trip) {
    return view('map', compact('trip'));
});

Route::get('/mobile-landing', function (Request $request) {
    return view('mobile-landing');
});

Route::get('/default-map', function (Request $request) {
    return view('default-map');
});

Route::get('/schedule/{user}', function (Request $request, User $user) {
    $type = Str::title($request->type);

    $profile = ("\\App\\Models\\$type")::whereUserId($user->id)->first();
    $param = $type == 'driver' ? 'driver_id' : 'client_id';
    if(is_null($profile)) return "No profile set.";
    $records = [];
    if ($type == 'Driver') {
        $records = VehicleRequestForm::whereDriverId($profile->id)->whereStatus('approved')->latest()->get();
    } else {
        $records = VehicleRequestForm::whereUserId($user->id)->whereStatus('approved')->latest()->get();
    }
    // $reservations = Reservation::whereStatus('Approved')->where([$param => $profile->id])->get();
    return view('schedule', compact('user', 'profile', 'records'));
});

Route::get('/chat/{user}/{otherUser}', function (Request $request, User $user, User $otherUser) {
    return view('chat', compact('user', 'otherUser'));
});

Route::get('/inbox/{user}', function (Request $request, User $user) {
    auth()->login($user);
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
    // dd($request->model);
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
        'status' => $request->status ?? 'pending',
    ]);

    alert()->success("Your request has been submitted!");
    return redirect()->to("/mobile-dashboard/" . auth()->id());
});

Route::get('/mobile-register', function () {
    return view('mobile-register');
});

Route::get('/help/{user}', function (Request $request, User $user) {
    auth()->login($user);
    return view('help');
});

Route::get('/trip-history/{user}', function (Request $request, User $user) {
    auth()->login($user);
    $records = VehicleRequestForm::whereUserId($user->id)->whereDate('date', '<', now())->whereStatus('approved')->latest()->get();
    return view('trip-history', compact('user', 'records'));
});

Route::post('/mobile-register', function (Request $request) {
    $data = $request->validate([
        'email' => ['unique:clients,email', 'required'],
        'department' => ['required'],
        'password' => ['required'],
        'employee_no' => ['required'],
        'phone' => ['required'],
        'last_name' => ['required'],
        'middle_name' => '',
        'first_name' => ['required'],
    ]);

    $user = User::create([
        'name' => "$request->first_name $request->last_name",
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'Normal',
    ]);

    $data['user_id'] = $user->id;


    Client::create($data);
    alert()->success('Your account has been registered, and subject for approval.');
    return back();
});


Route::get("/mobile-dashboard/{user}", function (Request $request, User $user) {
    auth()->login($user);
    return view('mobile-dashboard');
});

Route::get('/feedback/{vrf}', function (Request $request, VehicleRequestForm $vrf) {
    return view('feedback', compact('vrf'));
});

Route::post('feedback', function (Request $request) {
    Feedback::create([
        'vrf_id' => $request->vrf_id,
        'driver_id' => $request->driver_id,
        'star' => $request->star,
    ]);
    alert()->success('Your feedback has been submitted');
    return redirect('/mobile-dashboard/' . auth()->id());
});
