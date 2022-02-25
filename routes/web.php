<?php

use App\AES128;
use App\Models\Image;
use App\Aes as AppAes;
use App\Helpers\Dicom;
use phpseclib3\Crypt\AES;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::redirect('/', Nova::path());

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

Route::get(Nova::path() . '/login', [LoginController::class, 'showLoginForm']);
Route::post(Nova::path(). '/login', [LoginController::class, 'login'])->name('nova.login');


//testing

Route::get('/dcm-to-jpg', function () {
    return view('upload_test');
});


Route::post('/enc', function () {

    $newFile = Dicom::convertDicom(request()->image);
    // move_uploaded_file($newFile, public_path('sample.jpg'));
    return response()->download($newFile);
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/view-file', function (Request $request) {
    $image = Image::findOrFail($request->model);
    $key = $request->key;

    //decryption
    $aes = new AES128($key);
    $file = Storage::get('/public/' . $image->path);
    $result = $aes->decrypt($file);

    return response()->stream(function () use ($result) {
        $img = @imagecreatefromstring($result);
        imagejpeg($img);
    }, 200, ['content-type' => 'image/jpeg']);
});

Route::get('/reports',  function () {
    return view('report');
});
