<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinancialRatioController extends Controller
{
    public function liquidityRatio()
    {
        return view('liquidity_ratio');
    }
}
