<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Bus;
use App\Models\Trip;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function fetchBus(Request $request) {
        $timeId = $request->time_id;
        $tripId = $request->trip_id;

       return Bus::whereTripId($tripId)->whereTimeId($timeId)->first();
    }

    public function store(Request $request) {

        $data = $request->validate([
            'seat' => 'required',
            'time_id' => 'required',
            'trip_id' => 'required',
            'type' => 'required',
            'amount_payable' => 'required',
            'discount_id' => '',
            'date' => 'required',
            'user_id' => 'required',
            'discount_image_proof' => '',
        ]);
        $data['status'] =  Booking::STATUS_TO_PAY;
        $data['trip_details'] = json_encode(Trip::find($data['trip_id']));
        return Booking::create($data);
    }

    public function index () {
        return view('bookings');
    }

    public function getUserBookings (Request $request) {
        return Booking::whereUserId($request->user)->with('ticket')->latest()->get();
    }

    public function cancelBooking (Request $request) {
        $booking = Booking::find($request->booking_id);
        return $booking->cancel();
    }
}
