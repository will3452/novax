<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::get('/logout', function () {
    auth()->logout();
    return back();
})->name('nova.logout');


Route::get('/issue-documents', function (Request $request) {
    return view('indigency');
    return $request->all();
})->name('issue');


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
