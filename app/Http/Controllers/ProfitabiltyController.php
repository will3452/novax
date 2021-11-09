<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfitabiltyController extends Controller
{
    public function index()
    {
        return view('profitability');
    }
}
