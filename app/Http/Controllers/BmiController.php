<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BmiController extends Controller
{
    public function index () {
        return view('bmi.index');
    }

    public function save(Request $request) {
        $data = $request->validate([
            'weight' => 'required',
            'height' => 'required',
            'result' => 'required',
            'remarks' => 'required',
        ]);

        auth()->user()->bmis()->create($data);
        auth()->user()->deleteMealToday();
        return back()->withSuccess('Record has been saved!');
    }
}
