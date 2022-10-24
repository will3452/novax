<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PuzzleController extends Controller
{
    public function index () {
        return view('puzzle_index');
    }
}
