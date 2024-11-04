<?php

use App\Models\IngredientInventory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect()->to(config('nova.path'));
});


Route::get('/i-graphs', function () {
    $dailyUsage = IngredientInventory::whereType('USAGE')->select('ingredient_id', DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as c_date'), DB::raw('sum(quantity) as total'))->groupBy('ingredient_id', 'c_date')->get();
    $monthlyUsage = IngredientInventory::whereType('USAGE')->select('ingredient_id', DB::raw('DATE_FORMAT(created_at, "%Y-%m") as c_date'), DB::raw('sum(quantity) as total'))->groupBy('ingredient_id', 'c_date')->get();
    $yearlyUsage = IngredientInventory::whereType('USAGE')->select('ingredient_id', DB::raw('DATE_FORMAT(created_at, "%Y") as c_date'), DB::raw('sum(quantity) as total'))->groupBy('ingredient_id', 'c_date')->get();
    return view('i-graphs', compact('monthlyUsage', 'dailyUsage', 'yearlyUsage'));
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
