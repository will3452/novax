<?php

use App\Http\Controllers\AttemptController;
use App\Models\Module;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;

Route::redirect('/', Nova::path());

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/view-module-document/{module}', function (Module $module) {
    if ($module->status === Module::STATUS_DISABLED) {
        return 'The document is temporary locked!';
    }
    return view('module_show', compact('module'));
});

Route::get('/check-module/{module}', function (Module $module) {
    return $module->status;
});

Route::get('/take-quiz', [AttemptController::class, 'attempt'])
    ->middleware('auth');

Route::post('/submit-answers', [AttemptController::class, 'checkAnswers']);

Route::get('/error', fn () => 'Error! please contact your instructor!');


Route::get('/mark-as-read/{id}' , function ($id) {
    $notif = auth()->user()->notifications()->whereId($id)->first();
    $notif->markAsRead();
    return redirect()->to(Nova::path() . '/resources/modules/' . $notif->data['module_id']);
});
