<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Endpoint;
use App\Models\Reservation;
use App\Models\Vehicle;

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
    
    Route::post('/vehicle-form-requests', function (Request $request) {
        $data = $request->all();
        $data['user_id'] = auth()->id(); 
        return Vehicle::create($data); 
    }); 

    Route::get('/reservation-driver', function (Request $request) {
        $driverId = auth()->user()->driver->id; 
        return Reservation::whereDriverId($driverId)->get();
    }); 

    Route::get('/reservation-client', function (Request $request) {
        $clientId = auth()->user()->client->id; 
        return Reservation::whereClientId($clientId)->get();
    }); 
});

Route::get('/vehicles', function(Request $request) {
    return Vehicle::get(); 
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);



Route::any('/v1/{params}', function (Request $request, $params) {
    $method = Str::lower($request->getMethod()); 
    $path = $request->getPathInfo(); 
    $arr_path = explode("/", $path); 
    $name = end($arr_path); 
    $endpoint = Endpoint::whereMethod($method)->wherePath($name)->first(); 
    return [
        'params' => $endpoint, 
        'method' => Str::lower($request->getMethod()), 
    ]; 
}); 