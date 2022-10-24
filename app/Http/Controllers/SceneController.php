<?php

namespace App\Http\Controllers;

use App\Models\Scene;
use Illuminate\Http\Request;

class SceneController extends Controller
{
    public function show (Scene $scene) {
        $scene->load('objects');
        return view('scene_show', compact('scene'));
    }
}
