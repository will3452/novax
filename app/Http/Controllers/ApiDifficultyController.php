<?php

namespace App\Http\Controllers;

use App\Models\Difficulty;
use Illuminate\Http\Request;

class ApiDifficultyController extends Controller
{
    public function index()
    {
        return Difficulty::get();
    }
}
