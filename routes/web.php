<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    return redirect()->to(config('nova.path'));
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


Route::get('/financial-report', function (Request $request) {
    $selectedYear = $request->year ?? now()->year;
    $selectedMonth = $request->month ?? now()->month;
    return view('finance_report', compact('selectedMonth', 'selectedYear'));
});

Route::get('/progress-report', function (Request $request) {
    $selectedMonth = $request->month ?? now()->month;
    $selectedYear = $request->year ?? now()->year;
    return view('progress_report', compact('selectedMonth', 'selectedYear'));
});


Route::get('/summary-report', function (Request $request) {
    $selectedMonth = $request->month ?? now()->month;
    $selectedYear = $request->year ?? now()->year;
    return view('summary_report', compact('selectedMonth', 'selectedYear'));
});
