<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = Expert::get();
        return view('expert_index', compact('experts'));
    }
}
