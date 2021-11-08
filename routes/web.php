<?php

use App\Http\Controllers\PrintController;
use App\Http\Controllers\TAccountController;
use App\Models\StockTake;
use App\Models\User;
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

Route::redirect('/', '/nova/login');

Route::get('print-asset-register', [PrintController::class, 'printAssets']);
Route::get('print-stocks-report', [PrintController::class, 'printStocks']);
Route::get('/t-accounts', [TAccountController::class, 'index']);
Route::get('/trial-balance', [TAccountController::class, 'trialBalance']);
Route::get('/general-grournal', [TAccountController::class, 'generalJournal']);

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', function () {
    $data = request()->validate([
        'email'=>'required|email|unique:users,email',
        'password'=>'required',
        'name'=>'required'
    ]);

    User::create($data);

    return back()->withSuccess('Registered Successfully! You may now login.');
});
