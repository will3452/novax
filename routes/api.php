<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\CronJob;
use App\Models\Endpoint;

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

Route::get('/', function () {
    return response()->json([
        'name' => config('app.name'),
        'version' => config('app.version', '1.0.0'),
        'environment' => config('app.env'),
        'debug' => config('app.debug'),
        'url' => config('app.url'),
        'documentation_url' => config('app.documentation_url', 'https://docs.example.com')
    ]);
});


//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function (Request $request) {
        return now();
    });
    Route::prefix('users')->group(function () {
        Route::get('/me', function (Request $request) {
            return $request->user();
        });
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::prefix('guides')->group(function () {
        Route::get('/', [\App\Http\Controllers\GuideController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\GuideController::class, 'store']);
        Route::post('/helpful/{slug}', [\App\Http\Controllers\GuideController::class, 'helpful']);
    });
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::any('/cron', function (Request $request) {
    CronJob::create([]);
});

Route::get('/organizations', function () {
    return response()->json([
        'organizations' => \App\Models\Organization::whereStatus('ACTIVE')->get()
    ]);
});
