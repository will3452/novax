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

//private access
Route::middleware("auth:sanctum")->group(function () {
    Route::get("/auth-test", function () {
        return "authentication test";
    });
    Route::post("/logout", [ApiAuthenticationController::class, "logout"]);
});

Route::get("/public-test", function () {
    return "public test";
});

//user authentication
Route::post("/register", [ApiAuthenticationController::class, "register"]);
Route::post("/login", [ApiAuthenticationController::class, "login"]);

Route::any("/cron", function (Request $request) {
    CronJob::create([]);
});

Route::any("/v1/{params}", function (Request $request, $params) {
    $method = Str::lower($request->getMethod());
    $path = $request->getPathInfo();
    $arr_path = explode("/", $path);
    $name = end($arr_path);
    $endpoint = Endpoint::whereMethod($method)->wherePath($name)->first();
    return [
        "params" => $endpoint,
        "method" => Str::lower($request->getMethod()),
    ];
});

Route::get("/test", function () {
    $rows = app(\App\Services\GoogleSheetService::class)->getRows("A2:K");

    return $rows;
});

Route::get('/product-trend/{product}/{interval}', [\App\Http\Controllers\ProductController::class, 'trendData']);
