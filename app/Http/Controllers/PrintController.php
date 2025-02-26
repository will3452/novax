<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function invoice (Request $request, Invoice $invoice) {
        return view('print.invoice', compact('invoice'));
    }
}
