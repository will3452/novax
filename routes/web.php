<?php

use App\AES128;
use App\Models\Image;
use App\Aes as AppAes;
use phpseclib3\Crypt\AES;
use Illuminate\Http\Request;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Response;

Route::redirect('/', Nova::path());

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//testing

Route::get('/test', function () {
    return view('upload_test');
});

Route::post('/enc', function () {
    $image = request()->image->get();

    $im = @imagecreatefromstring($image);
    $colors = [];
    $width = imagesx($im) / 3;
    $height = imagesy($im) / 3;
    for ( $x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $rgb = imagecolorat($im, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $colors[$x][$y] = ['r' => $r, 'g' => $g, 'b' => $b];
        }
    }
    return view('result', compact('colors', 'height', 'width'));
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

Route::get('/reports', fn () => 'no report found.');
