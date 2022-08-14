<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function scan (Request $request) {
        return view('scan');
    }
}
