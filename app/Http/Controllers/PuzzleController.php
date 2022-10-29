<?php

namespace App\Http\Controllers;

use App\Models\PairedThing;
use Illuminate\Http\Request;

class PuzzleController extends Controller
{
    public function index () {
        return view('puzzle_index');
    }

    public function matching() {
        $p1 = PairedThing::inRandomOrder()->take(5)->get();

        $ids = array_map(fn ($e) => $e->id, $p1->all());

        $p2 = PairedThing::whereIn('id',  $ids)->inRandomOrder()->get();

        return view('matching_index', compact('p2', 'p1'));
    }
}
