<?php

use App\Models\User;
use App\Services\Payment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
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

Route::get('/send-verification', function() {
    Mail::to(auth()->user())->send(new EmailVerification(auth()->user()));
    return "please click on the verification link we have sent to your email address. If you have not received the email, please check your spam or junk folder.";
})->name('send-link');

Route::get('/verify-account', function() {

    if (request()->hasValidSignature()) {
        $user = User::find(request()->id);
        $user->update(['email_verified_at' => now()]);
        auth()->loginUsingId(request()->id);

        return redirect('/app');
    } else {
        abort(403, 'Unauthorized access');
    }

})->name('account_verify');


Route::get('notifications', function () {
    $app = Appointment::whereUserId(auth()->id())->where(['alert' => 1])->first();
    $message = '';
    if ($app) {
        $message = $app->description_1;
    }
    return ['message' => $message];
})->name('notifications');


Route::get('/redirect-link', function () {
    $app = Appointment::findOrFail(request()->link);

    if ($app->user_id == auth()->id()) {
        $app->update(['alert' => 0]);
    } else if (auth()->id() != 1) {
        return abort(401);
    }

    return redirect()->to($app->link);
});
