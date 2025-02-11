<?php

namespace App\Http\Controllers;

use App\Models\RequestOfTravel;
use Illuminate\Http\Request;

class RequestOfTravelController extends Controller
{
    public function index () {
        return view('rot');
    }

    public function create() {
        return view('rotc');
    }
    public function store (Request $request) {
        $data = $request->validate([
            'admin_id' => ['required'],
            'user_id' => ['required'],
            'purpose' => ['required'],
            'date' => ['required'],
            'vehicle_id' => ['required'],
            'passengers' => [],
            'destination' => [],
        ]);

        RequestOfTravel::create($data);
        alert()->success('Success', "Request of travel has been submitted!");
        return redirect()->to('/mobile-dashboard/'.auth()->id());
    }
}
