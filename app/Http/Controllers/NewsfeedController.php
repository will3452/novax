<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class NewsfeedController extends Controller
{
    public function index (Request $request) {
        $posts = [];
        if (request()->has('keyword')) {
            $posts = Post::where('title', 'LIKE', "%$request->keyword%")->get();
        } else {
            $posts = Post::latest()->limit(10)->get();
        }

        return view('newsfeed.index', compact('posts'));
    }

    public function create() {
        return view('newsfeed.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => ['required'],
            'content' => ['required', 'max:500'],
            'category' => ['required']
        ]);

        $data['user_id'] = auth()->id();

        Post::create($data);

        alert()->success('Your post has been published ! ');

        return back();
    }
}
