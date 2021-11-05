<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $shops = null;
        $keyword = request()->keyword;

        if (request()->status == 'all' || !request()->has('status')) {
            $shops = Shop::where('description', 'LIKE', "%$keyword%")->get();
        } else {
            $shops = Shop::where('status', request()->status)->where('description', 'LIKE', "%$keyword%")->get();
        }

        $limit = request()->limit ?? 10;

        $shops = $shops->take($limit);

        return view('search', compact('shops'));
    }
}
