<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Models\Progress;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/app/login', function () {
    return redirect()->to('/');
}); 

Route::get('/form', function (Request $request) {
    $progress = Progress::find($request->model);
    $progress->load('section', 'group');  
    
    return view('form', ['progress' => $progress]); 
})->name('form'); 


Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
