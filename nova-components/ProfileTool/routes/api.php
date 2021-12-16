<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/current-user', function (Request $request) {
    return $request->user();
});

Route::post('/update', function (Request $request) {
    $user = $request->user();

    if ($request->has('name')) {
        $user->update([
            'name'=>$request->name
        ]);
    }

    if ($request->has('email')) {
        $user->update([
            'email'=>$request->email
        ]);
    }

    if ($request->has('address')) {
        $user->update([
            'address'=>$request->address
        ]);
    }

    if ($request->has('logo') && request()->logo != null) {
        $user->update([
            'logo'=>$request->logo->store('public'),
        ]);
    }

    if ($request->has('password')) {
        $user->update([
            'password'=>bcrypt($request->password),
        ]);
    }

    $user->save();
    return $user;
});
