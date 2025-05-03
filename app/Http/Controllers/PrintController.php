<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Sale;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function invoice (Request $request, Invoice $invoice) {
        return view('print.invoice', compact('invoice'));
    }

    public function inventory(Request $request) {
        $branch = Branch::findOrFail($request->branch_id);
        $brand = Brand::findOrFail($request->brand_id);
        $productIds = Product::whereBrandId($brand->id)->get()->pluck('id');
        $items = Inventory::whereIn('product_id', $productIds->toArray())->whereBranchId($branch->id)->get();
        return view('print.inventories', compact('items', 'branch',));
    }

    public function summaryReport(Request $request, ) {
        $from = $request->from;
        $to = $request->to;
        $dates = $this->generateDateSeries($from, $to);
        $branch = Branch::findOrFail($request->branch_id);
        return view('print.summary-report', compact('dates', 'branch', 'from', 'to'));
    }

    public function orderSlip(Request $request, Sale $sale) {
        $sale->load('items');
        return view('print.order-slip', compact('sale'));
    }

    function generateDateSeries($startDate, $endDate) {
        $period = CarbonPeriod::create($startDate, $endDate);

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->toDateString();
        }

        return $dates;
    }

    public function dailySales(Request $request) {
        $from = $request->from;
        $to = $request->to;
        $dates = $this->generateDateSeries($from, $to);
        $branch = Branch::findOrFail($request->branch_id);
        return view('print.daily-sales', compact('dates', 'branch'));
    }
}
