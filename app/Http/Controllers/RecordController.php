<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index () {
        $records = Record::whereUserId(auth()->id())->get();
        return view('records.index', compact('records'));
    }

    public function store(Request $request) {
        return Record::create([
            'user_id' => auth()->id(),
            'weight' => $request->weight,
            'height' => $request->height,
            'scale' => $request->scale,
            'result' => $request->result,
        ]);
    }
}
