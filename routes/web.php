<?php

use App\Accounting;
use App\Models\User;
use App\Models\StockTake;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\FinacialStatement;
use App\Http\Controllers\TAccountController;
use App\Http\Controllers\FinancialRatioController;
use App\Http\Controllers\Nova\Auth\LoginController;
use App\Http\Controllers\ProfitabiltyController;
use App\Models\Account;

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
Route::post(Nova::path().'/login', [LoginController::class, 'login'])->name('nova.login');
Route::redirect('/', '/nova/login');

Route::get('print-asset-register', [PrintController::class, 'printAssets']);
Route::get('print-stocks-report', [PrintController::class, 'printStocks']);
Route::get('/t-accounts', [TAccountController::class, 'index']);
Route::get('/trial-balance', [TAccountController::class, 'trialBalance']);
Route::get('/general-grournal', [TAccountController::class, 'generalJournal']);
Route::get('incoming-statement', [FinacialStatement::class, 'incomingStatement']);
Route::get('financial-position', [FinacialStatement::class, 'financialposition']);
Route::get('/owners-equity', [FinacialStatement::class, 'ownersEquity']);
Route::get('/liquidity-ratio', [FinancialRatioController::class, 'liquidityRatio']);
Route::get('/profitability-ratio', [ProfitabiltyController::class, 'index']);
Route::get('/register', function () {
    return view('register');
});

Route::post('/register', function () {
    $data = request()->validate([
        'email'=>'required|email|unique:users,email',
        'password'=>'required|confirmed',
        'name'=>'required',
    ]);

    $data['password'] = bcrypt($data['password']);

    User::create($data);

    return back()->withSuccess('Registered Successfully! You may now login.');
});


Route::get('/test', function () {
    return 5.93 > 1.0;
});
