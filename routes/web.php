<?php

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
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
    try {
        $exists = Appointment::whereSlot($request->slot)->whereDate('date', $request->date)->exists();

        if (! $exists) {
            Appointment::create([
                'slot' => $request->slot,
                'service' => $request->service,
                'patient_id' => $request->patient_id,
                'remarks' => $request->remarks,
                'date' => $request->date,
            ]);
        } else {
            alert()->error('Error','Schedule is already taken');
            return redirect()->back();
        }


        alert()->success('Success','Appointment has been submitted');

        return back();
    } catch (Exception $e) {
        alert()->error('Please fill the form.');
        return back();
    }
});

Route::post('/cancel', function (Request $request) {
    $app = Appointment::findOrFail($request->appointment_id);
    $app->update(['status' => 'Cancelled']);
    alert()->success('Your appointment has been cancelled!');
    return back();
});

Route::get('/dental-record/{user}', function (Request $request, User $user) {
    if (! $user->dentalRecord) {
        alert()->error('No Dental Record!');
        return back();
    }
    return view('dental_record', compact('user'));
})->middleware(['auth']);

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
