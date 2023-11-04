<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index () {
        $news = News::latest()->get(); 
        return view('news', compact('news')); 
    }

    public function show(News $post) {
        return view('news_show', compact('post')); 
    }
}
