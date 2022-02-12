<?php

use App\Aes as AppAes;
use App\AES128;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use phpseclib3\Crypt\AES;

Route::redirect('/', Nova::path());

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//testing

Route::get('/test', function () {
    return view('upload_test');
});

Route::post('/enc', function () {
    $image = request()->image->get();

    $image = base64_encode($image);


    $key = AES128::generateKey();

    $aes = new AES128($key);

    $encrypted = $aes->encrypt($image);

    $filename = uniqid() . '.dat';

    Storage::put("public/$filename", $encrypted);

    $decrypted = base64_decode($aes->decrypt($encrypted));

    return view('result', compact('encrypted', 'decrypted'));
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
