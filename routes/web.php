<?php

use App\Http\Controllers\PrintController;
use App\Http\Controllers\TAccountController;
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
Route::get('/t-accounts', [TAccountController::class, 'index']);
Route::get('/trial-balance', [TAccountController::class, 'trialBalance']);
Route::get('/general-grournal', [TAccountController::class, 'generalJournal']);
