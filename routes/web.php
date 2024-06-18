<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Models\Group;
use App\Models\OralDefenseRequest;
use App\Models\Progress;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/app/login', function () {
    return redirect()->to('/');
}); 

Route::get('/form', function (Request $request) {
    $response = []; 
    if ($request->form == 'progress') {
        $progress = Progress::find($request->model);
        $progress->load('section', 'group');  
        $response['progress'] = $progress; 
    }

    if ($request->form == 'oral_defense') {
        $oral_defense = OralDefenseRequest::find($request->model); 
        $oral_defense->load('section.course', 'group.title'); 
        $response['oral_defense'] = $oral_defense; 
    }

    if ($request->form == 'acceptance' || $request->form == 'revision') {
        $group = Group::find($request->model); 
        $group->load('title'); 
        $response['group'] = $group; 
    }
    
    return view('form', $response); 
})->name('form'); 


Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
