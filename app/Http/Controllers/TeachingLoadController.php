<?php

namespace App\Http\Controllers;

use App\Models\TeachingLoad;
use Illuminate\Http\Request;

class TeachingLoadController extends Controller
{
    public function index () {
        return view('teaching-loads.index');
    }

    public function show(TeachingLoad $load) {
        $load->load('subject');
        return view('teaching-loads.show', compact('load'));
    }
}
