<?php

use App\Models\Appointment;
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

Route::get('/appointments', function (Request $request) {
    $app = Appointment::whereStatus('Approved')->get();
    $app->load('patient');
    return $app;
});

Route::post('/appointments/{app}', function(Request $request, Appointment $app) {
    $app->update(['status' => $request->status]);
    return 'ok';
});
