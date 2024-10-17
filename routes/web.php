<?php

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    return view('welcome');
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified');
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index']);
Route::get('/reserve/{service}', function (Request $request, Service $service) {
    return view('reserve', compact('service'));
})->middleware(['auth']);

Route::post('/reserve', function (Request $request) {
    [$time_start, $time_end ] = explode('-', $request->slot);

    Appointment::create([
        'time_start' => $time_start,
        'time_end' => $time_end,
        'service' => $request->service,
        'patient_id' => $request->patient_id,
        'remarks' => $request->remarks,
        'date' => $request->date,
    ]);

    return redirect()->to('/home');
});

Route::get('/faq', function (Request $request) {
    return view('faq');
});


Route::get('/admin-notifications', function (Request $request) {
    return view('admin_notification');
});

Route::get('/notifications', function (Request $request) {
    return view('user_notification');
});

Route::post('/admin-notifications/{notification}', function (Request $request, $notification) {
    auth()->user()->notifications()->find($notification)->markAsRead();

    return back();
});
