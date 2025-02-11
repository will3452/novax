<?php

namespace App\Http\Controllers;

use App\Models\TravelOrder;
use Illuminate\Http\Request;

class TravelOrderController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'unit' => ['required'],
            'destination' => ['required'],
            'date_of_travel' => ['required'],
            'purpose' => ['required'],
            'option' => ['required'],
            'approved_by_id' => [],
            'noted_by_id' => [],
            'user_id' => ['required']
        ]);
        $data['option'] = json_encode($data['option']);
        $data['no'] = now()->timestamp;
        TravelOrder::create($data);

        alert()->success('Success', "Travel Order has been submitted");
        return redirect()->to('/mobile-dashboard/' . auth()->id());
    }
}
