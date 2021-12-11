<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

Route::get('/get-records', function (Request $request) {
    $records = auth()->user()->userRecords;

    foreach ($records as $record) {
        $record->company_due_date = " ".$record->record->company_due_date->format('m-d-Y');
        $record->customer_due_date = " ".$record->record->customer_due_date->format('m-d-Y');
    }

    return [
        'records' => $records,
    ];
});

Route::post('/submit-work-hour', function (Request $request) {
    $records = $request->validate([
        'record_id' => 'required',
        'hour' => 'required'
    ]);

    $workingHour = auth()->user()->workingHours()->create($records);

    return $workingHour;
});
