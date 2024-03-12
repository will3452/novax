<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {
    return redirect('/admin'); 
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/career-trajectory', function () {
    $records = \App\Models\ProfessionalRecord::groupBy('career')->select('career', DB::raw('count(*) as count'))->get();
    // return $records; 
    return view('career-trajectory', compact('records')); 
}); 