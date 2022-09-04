<?php

use App\Services\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Models\Appointment;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('paynow', function (Request $request) {
    try {
        $app = Appointment::find($request->appointment);

        if (! $app) throw new Error('Appointment not found!', 400);


        $payment =  Payment::make()
        ->setAmount(nova_get_setting('appointment_fee', 100))
        ->setDescription('Pay appointment')
        ->gcash();
        $obj = json_decode($payment);

        $requestId = $obj->data->request_id;

        $app->update(['request_id' => $requestId]); // attached request id

        $url = $obj->data->checkouturl;

        return redirect($url);
    } catch(Exception $error) {
        return $error->getMessage();
    }
});
