<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/admin');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

// Route::get('/test', function (Messaging $messaging) {
//     $messaging->send(['notification' => ['title' => 'demo', 'body' => 'this is demo'], 'token' => 'daOWxE7jHxMduDcdGQecUI:APA91bHa5HTUhF3vcBdvJY7OecVCym5yCrqGODRAudOGAXLUjkjnnuNPHgYq_hZ-TF9F8eBEJ-6PjJgRXKG8H1qxC_6DJ__5bXnolR8Rh677ryS6PSfy777p5-qDkjiRESvHGWi9WKpv']);
//     return 'test';
// });
