<?php

use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;


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
