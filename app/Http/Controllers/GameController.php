<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('game_index');
    }
    public function sudoku()
    {
        return view('sudoku');
    }

    public function flipCard()
    {
        $images = auth()->user()->images()->inRandomOrder()->limit(6)->get();
        return view('flip-card', compact('images'));
    }
}
