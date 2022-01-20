<?php

namespace App\Http\Controllers;

use App\Models\CovidInfo;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function index()
    {
        return view('covid_index');
    }

    public function show(CovidInfo $covidInfo)
    {
        return view('covid_show', compact('covidInfo'));
    }
}
