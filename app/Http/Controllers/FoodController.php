<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(Request $request) {

        $filters = [];

        if ($request->has('type') && $request->type != '') {
            $filters['type'] = $request->type;
        }

        $foods = Meal::where($filters)->get();
        return view('foods.index', compact('foods'));
    }
}
