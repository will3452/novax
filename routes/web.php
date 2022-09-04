<?php

use App\Services\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;


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
    $payment =  Payment::make()
        ->setAmount(nova_get_setting('appointment_fee', 100))
        ->setDescription('Pay appointment')
        ->gcash();
        $obj = json_decode($payment);

        $url = $obj->data->checkouturl;

        return redirect($url);
});
