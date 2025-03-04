<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function invoice (Request $request, Invoice $invoice) {
        return view('print.invoice', compact('invoice'));
    }

    public function orderSlip(Request $request, Sale $sale) {
        $sale->load('items');
        return view('print.order-slip', compact('sale'));
    }
}
