<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = auth()->user()->albums()->get();
        return view('gallery.album_index', compact('albums'));
    }

    public function imageIndex()
    {
        $images = auth()->user()->images()->whereAlbumId(request()->album)->latest()->get();
        return view('gallery.index', compact('images'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'album_id' => ['required', 'exists:albums,id'],
            'file' => 'image|required|max:5000',
            'caption' => 'required',
            'title' => 'required',
        ]);

        $path = $data['file']->store('public');
        unset($data['file']);// remove the file in data array
        $arrayPath = explode('/', $path);
        $data['path'] = end($arrayPath);

        auth()->user()->images()->create($data);
        $album = $data['album_id'];
        return redirect('/images/' . "?album=$album&alert=new image has been uploaded!");
    }

    public function delete(Image $image)
    {
        $image->delete();
        return redirect(route('gallery') . "?alert=image has been removed!");
    }
}
