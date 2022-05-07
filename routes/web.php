<?php

use App\AES128;
use App\Models\Image;
use App\Aes as AppAes;
use App\Helpers\Dicom;
use phpseclib3\Crypt\AES;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

Route::get(Nova::path() . '/login', [LoginController::class, 'showLoginForm']);
Route::post(Nova::path(). '/login', [LoginController::class, 'login'])->name('nova.login');

Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::get('/key', function (Request $request) {
    return $request->key;
});
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
function createFileObject($url){

    $path_parts = pathinfo($url);

    $newPath = $path_parts['dirname'] . '/tmp-files/';
    if(!is_dir ($newPath)){
        mkdir($newPath, 0777);
    }

    $newUrl = $newPath . $path_parts['basename'];
    copy($url, $newUrl);
    $imgInfo = getimagesize($newUrl);

    $file = new UploadedFile(
        $newUrl,
        $path_parts['basename'],
        $imgInfo['mime'],
        filesize($url),
        true,
        TRUE
    );

    return $file;
}
Route::get('/change-key', function (Request $request) {
    $image = Image::findOrFail($request->model);
    $key = $request->key;
    try {
        //decryption
        $aes = new AES128($key);
        $file = Storage::get('/public/' . $image->path);
        $result = $aes->decrypt($file);

        $img = @imagecreatefromstring($result);
        $im = imagejpeg($img, public_path('ss.jpg'));
        if ($im) {
            [$key, $path] = AES128::storeFile(createFileObject(public_path('ss.jpg')));
            return $path;
            $image->update([
                'path' => $path,
            ]);
            return response()->streamDownload(function () {
                echo $key;
            }, 'new-key.txt');
        }

    } catch(Exception  $e) {
        echo $e->getMessage();
    }
});

Route::get('/view-file', function (Request $request) {
    $image = Image::findOrFail($request->model);
    $key = $request->key;

    try {
        //decryption
        $aes = new AES128($key);
        $file = Storage::get('/public/' . $image->path);
        $result = $aes->decrypt($file);

        return response()->stream(function () use ($result) {
            $img = @imagecreatefromstring($result);
            imagejpeg($img);
        }, 200, ['content-type' => 'image/jpeg']);
    } catch(Exception  $e) {
        echo 'Incorrect key!';
    }
});

Route::get('/reports',  function () {
    return view('report');
});
