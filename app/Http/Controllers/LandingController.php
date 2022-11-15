<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request) {


        $products = [];

        if ($request->has('category') && $request->has('keyword')) {
            $category = $request->category == '*' ? null: $request->category;

            if ($category != null) {
                $products = Product::where('name', 'LIKE', "%$request->keyword%")->whereCategoryId($category)->get();
            } else {
                $products = Product::where('name', 'LIKE', "%$request->keyword%")->get();
            }
        } else if($request->has('category')) {
            $category = $request->category == '*' ? null: $request->category;

            if ($category != null) {
                $products = Product::whereCategoryId($category)->get();
            } else {
                $products = Product::get();
            }
        } else if($request->has('keyword')) {
            $products = Product::where('name', 'LIKE', "%$request->keyword%")->get();
        } else {
            $products = Product::get();
        }

        return view('welcome', compact('products'));
    }
}
