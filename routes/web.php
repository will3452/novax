<?php

use App\Http\Controllers\MapController;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Models\Farm;

Route::get('/', function () {
    return redirect(Nova::path());
});

Route::get('/map/', [MapController::class, 'showMap']);
Route::post('map/{farm}', [MapController::class, 'setPin']);

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
