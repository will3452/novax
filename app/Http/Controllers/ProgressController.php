<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function submitProgress (Request $request) {
        $type = "\\App\\Models\\" . $request->type;
        $alert = $request->alert ?? 'Record has been saved!';
        auth()->user()->progress()->create([
            'model_type' => $type,
            'model_id' => $request->id,
        ]);
        alert($alert);
        return back();
    }

    public function index () {
        return view('progress.index', ['progress' => auth()->user()->progress]);
    }
}
