<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiSearchProductController extends Controller
{
    public function search(SearchRequest $r)
    {
        $r->validated();
        $products = Product::where('name', 'LIKE', "%" . $r->keyword . "%")
            ->orWhere('description', 'LIKE', "%" . $r->keyword . "%")
            ->get();
        return $products;
    }
}
