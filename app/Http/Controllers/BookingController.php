<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Shop;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookToday(Shop $shop)
    {
        $services = '';
        if(request()->has('services')){
            $services = implode(', ', request()->services);
        }

        Booking::create([
            'user_id'=>auth()->id(),
            'shop_id'=>$shop->id,
            'services' => $services,
        ]);
        return back()->withSuccess('Booked Successfully');
    }

    public function index()
    {
        $bookings = auth()->user()->bookings()->latest()->get();
        return view('book_list', compact('bookings'));
    }
}
