<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'trip_id' => 'required',
            'amount_payable' => 'required',
            'discount_id' => '',
            'date' => 'required',
            'user_id' => 'required'
        ]);
        $data['trip_details'] = json_encode(Trip::find($data['trip_id']));
        return Booking::create($data);
    }
}
