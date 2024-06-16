<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Models\Supervision;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');  
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::get('/register-hte', function () {
    return view('auth.register-hte'); 
}); 

Route::get('/register-coordinator', function () {
    return view('auth.register-coordinator'); 
}); 


Route::post('/register-trainee', function (Request $request) {
    $data = $request->validate([
        'coordinator' => ['required', 'exists:users,email'], 
        'email' => ['required', 'unique:users,email'],
        'password' => ['required', 'confirmed'],
        'name' => 'required',
        'school' => ['required'], 
    ]);
    $coordinator = $data['coordinator']; 
    $data['coordinator'] = null; 
    $head = User::whereEmail($coordinator)->first();
    
    $data['password'] = bcrypt($data['password']); 
    $member = User::create($data); 

    Supervision::create([
        'head_id' => $head->id, 
        'member_id' => $member->id, 
    ]); 

    alert()->success("Success", "Registered Successfully!"); 

    return redirect()->back(); 
}); 

Route::post('/register-hte', function (Request $request) {
    $data = $request->validate([
        'email' => ['required', 'unique:users,email'],
        'password' => ['required', 'confirmed'],
        'name' => 'required',
        'lat' => ['required'], 
        'address' => ['required'], 
        'lng' => ['required'], 
    ]);
    $data['password'] = bcrypt($data['password']); 
    $data['type'] = User::TYPE_HTE; 
    User::create($data); 

    alert()->success("Success", "Registered Successfully!"); 

    return redirect()->back(); 
}); 

Route::post('/register-coordinator', function (Request $request) {
    $data = $request->validate([
        'email' => ['required', 'unique:users,email'],
        'password' => ['required', 'confirmed'],
        'name' => 'required',
    ]);
    $data['password'] = bcrypt($data['password']); 
    $data['type'] = User::TYPE_COORDINATOR; 
    User::create($data); 

    alert()->success("Success", "Registered Successfully!"); 

    return redirect()->back(); 
}); 


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/map', function () {
    return view('map'); 
}); 
