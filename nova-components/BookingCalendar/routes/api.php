<?php

use App\Models\Booking;
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

Route::get('/get-approved-bookings', function (Request $request) {
    return Booking::whereStatus(Booking::BOOKING_STATUS_APPROVED)->get()->map(function ($query) {
        $room = $query->room->name;
        return [
            'reference_number' => $query->reference_number,
            'title' => "$room - $query->customer_name",
            'startDate' => $query->arrival->format('Y-m-d'),
            'endDate' => $query->departure->format('Y-m-d'),
            'time' => $query->arrival->format('H:i A') . ' - ' .$query->departure->format('H:i A'),
            'id'=>$query->id,
            'customer_name' => $query->customer_name,
        ];
    });
});
