<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index (Request $request) {
        $keyword = $request->keyword;
        $profiles = Profile::where('first_name', 'LIKE', "%$keyword%")->orWhere('last_name', 'LIKE', "%$keyword%")->orWhere('middle_name', 'LIKE', "%$keyword%")->get();

        return view('search.index', compact('profiles'));
    }
}
