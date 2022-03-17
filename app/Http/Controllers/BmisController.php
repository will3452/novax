<?php

namespace App\Http\Controllers;

use App\Models\Bmi;
use Illuminate\Http\Request;

class BmisController extends Controller
{
    public function index()
    {
        return view('bmi_calculate');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'm' => 'required',
            'kg' => 'required',
            'remarks' => 'required'
        ]);
        $data['user_id'] = auth()->id();
        Bmi::create($data);
        return back()->withAlert('record');
    }
}
