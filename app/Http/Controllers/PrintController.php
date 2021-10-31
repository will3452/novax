<?php

namespace App\Http\Controllers;

use App\Models\Asset;
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
}
