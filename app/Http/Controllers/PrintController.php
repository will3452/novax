<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\StockTake;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printAssets()
    {
        $assets = null;
        if (request()->id == 'all') {
            $assets = Asset::get();
        } else {
            $ids = explode(',', request()->id);
            $assets = Asset::find($ids);
        }
        return view('print.assets', compact('assets'));
    }

    public function printStocks()
    {
        $stocks = null;
        if (request()->id == 'all') {
            $stocks = StockTake::latest()->get();
        } else {
            $ids = explode(',', request()->id);
            $stocks = StockTake::find($ids);
        }
        return view('print.stocks', compact('stocks'));
    }
}
