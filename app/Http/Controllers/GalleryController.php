<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $images = auth()->user()->images()->latest()->simplePaginate(5);
        return view('gallery.index', compact('images'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'file' => 'image|required|max:5000',
            'caption' => 'required',
            'title' => 'required',
        ]);

        $path = $data['file']->store('public');
        unset($data['file']);// remove the file in data array
        $arrayPath = explode('/', $path);
        $data['path'] = end($arrayPath);

        auth()->user()->images()->create($data);

        return redirect(route('gallery') . "?alert=new image has been uploaded!");
    }

    public function delete(Image $image)
    {
        $image->delete();
        return redirect(route('gallery') . "?alert=image has been removed!");
    }
}
