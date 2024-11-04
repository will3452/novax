<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    return redirect()->to(config('nova.path'));
});


Route::get('/i-graphs', function () {
    return view('i-graphs');
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
