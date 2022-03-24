<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function showMap()
    {
        $farm = Farm::find(request()->farm);
        $farms = Farm::whereNotNull('coordinates')->get();
        return view('welcome', compact('farm', 'farms'));
    }

    public function setPin(Request $request, Farm $farm)
    {
        $farm->setPin($request->coordinates, $request->color, $request->fill);
        return 'success!';
    }
}
