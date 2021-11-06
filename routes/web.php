<?php

use App\Http\Controllers\PrintController;
use App\Models\StockTake;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('print-asset-register', [PrintController::class, 'printAssets']);
Route::get('print-stocks-report', [PrintController::class, 'printStocks']);

Route::get('/test', function () {
    return StockTake::get()->groupBy(function ($stock) {
        return $stock->created_at->format('Y-m-d');
    });
});
