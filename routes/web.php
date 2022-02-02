<?php

use App\Models\Score;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', Nova::path());
//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/check-time', function () {
    return [
        'timezone' => config('app.timezone'),
        'time_now' => now(),
        'time_readable' => now()->format('h:i A'),
    ];
});

Route::get('/scores', function() {
    $scores = Score::get();

    $finalScores = [];

    foreach ($scores as $score) {
        $score->readable_date = $score->created_at->format('m-d-Y h:i a');
        $finalScores[] = $score;
    }
    return $finalScores;
});
