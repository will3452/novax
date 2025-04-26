<?php

use App\Models\Sale;
use App\Models\CronJob;
use App\Models\Endpoint;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Inventory;

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

Route::get('update-inventory', function (Request $request) {
    $inventories = Inventory::with('product')->get();
    $total = 0;
    foreach ($inventories as $i) {
        $total ++;
        if (! ($i->product && $i->product->name)) continue;
        $i->update(['product_name' => $i->product->name]);
    }
    return $total;
});

Route::get('update-cost', function (Request $request) {
    $sales = Sale::with('items')->get();
    $count_updated = 0;
    foreach ($sales as $s) {

        $total_cost = 0;
        foreach ($s->items as $item) {
            $total_cost += ($item->salable->cost * $item->qty);
        }

        $s->update(['total_cost' => $total_cost]);
        $count_updated ++;
    }

    return $count_updated;

});
