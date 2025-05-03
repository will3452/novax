<?php

use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect()->to('/admin');
})->name('login');

Route::get('/', function () {
    return redirect()->to(config('nova.path'));
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::middleware(['auth'])->prefix('print')->name('print.')->group(function () {
    Route::get('/invoice/{invoice}', [PrintController::class, 'invoice'])->name('invoice');
    Route::get('/order-slip/{sale}', [PrintController::class, 'orderSlip'])->name('order-slip');
    Route::get('/daily-sales', [PrintController::class, 'dailySales'])->name('daily-sales');
    Route::get('/summary-report', [PrintController::class, 'summaryReport'])->name('summary-report');
    Route::get('/inventory', [PrintController::class, 'inventory'])->name('inventory');
});
