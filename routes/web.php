<?php

use App\Models\Club;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\College;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistrationController;


Route::get('/', fn () => 'welcome to the app');

Route::get('/register', [RegisterController::class, 'registerScholar']);

Route::post('/register', [RegisterController::class, 'registerScholarPost']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


//ajax requests
Route::get('/colleges', fn () =>
    College::get()
);

Route::get('/courses', fn () =>
    Course::whereCollegeId(request()->college_id)->get()
);

Route::get('/clubs', fn () =>
    Club::whereCollegeId(request()->college_id)->get()
);
