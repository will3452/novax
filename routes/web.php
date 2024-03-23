<?php

use App\Models\Slot;
use App\Models\User;
use App\Models\Booking;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


function getLocation($lat, $lng) {
    try {
        $client = new Client();
        $res = $client->get("https://api.mapbox.com/search/searchbox/v1/reverse?longitude=$lng&latitude=$lat&access_token=pk.eyJ1IjoiZWxlemVya3ciLCJhIjoiY2wxNHE4d2E5MHRvMTNkczA1anltY3lybSJ9.T2bcLRSnEZB_LNGM7Qs5Mw"); 
        $body = $res->getBody(); 
        return json_decode($body->getContents())->features[0]->properties->place_formatted; 
    } catch (Exception $e) {
        return $e; 
        return "---"; 
    }
} 

Route::get('login', function (Request $request){
    return view('login'); 
})->name('login'); 

Route::get('/app/login', function (Request $request){
    return view('login'); 
})->name('nova.login');

Route::post('/login', function (Request $request) {
    $creds = $request->validate([
        'email' => ['email', 'exists:users,email'],
        'password' => ['required'],
    ]);

    if (! auth()->attempt($creds)) {
        alert()->error('Error', 'Incorrect email/password.'); 
        return back(); 
    }

    if (auth()->user()->approved_at == null && auth()->user()->type != User::TYPE_ADMINISTRATOR) {
        auth()->logout();
        alert()->warning('Warning', 'your account is not yet approved. please contact the administrator'); 
        return back(); 
    }

    return redirect()->to('/app/'); 
})->name('nova.login'); 

Route::get('/redirecting', function(Request $request){
    return redirect('/app'); 
})->name('login'); 

Route::get('/', function () {
    return view('welcome');
})->name('welcome.page');

Route::view('booking', '/booking')->middleware(['auth'])->name('booking.page'); 
Route::post('booking', function (Request $request) {
    $data = $request->validate([
        'origin' => ['required'],
        'destination' => ['required'],
        'number_of_passenger' => ['required']
    ]);

    // find slot 
    $slot = Slot::whereIsAvailable(true)->first(); 
    if (! $slot) {
        return "No Slot Available!"; 
    }

    // geocoding 

    
    $data['passenger_id'] = auth()->id(); 
    $data['driver_id'] = $slot->user_id; 
    $data['payable'] = 'TBA'; 
    $data['reference'] = Str::random(); 
    $data['from_coords'] = $data['origin']; 
    $data['to_coords'] = $data['destination']; 


    $lngLat = explode(',', $data['origin']); 
    $lngLatDes = explode(',', $data['destination']); 

    $data['origin'] = getLocation($lngLat[1], $lngLat[0]);
    $data['destination'] = getLocation($lngLatDes[1], $lngLatDes[0]);

    alert()->success('Success', 'Booking has been created, please wait to be confirmed by driver.'); 
    
    Booking::create($data); 

    return redirect('/app/resources/bookings'); 
})->name('booking.post'); 


Route::get('/test', function () {
    return getLocation(34.023653, -118.471383); 
}); 



Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'email' => ['email', 'required', 'unique:users,email'],
        'password' => ['required', 'min:6'],
        'name' => ['required'],
        'type' => ['required'], 
    ]);

    $data['password'] = bcrypt($data['password']); 

    $user = User::create($data); 
    auth()->login($user);

    return redirect()->to('/app'); 
})->name('register.post');
Route::view('/register', 'register')->name('register.page'); 

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
