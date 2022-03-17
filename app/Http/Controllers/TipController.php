<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function index()
    {
        $tip = null;
        if (request()->has('old')) {
            $tip = Tip::where('id', '!=', request()->old)->inRandomOrder()->first();
        } else {
            $tip = Tip::inRandomOrder()->first();
        }
        return view('health_tips', compact('tip'));
    }
}
