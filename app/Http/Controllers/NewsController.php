<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index () {
        $announcements = Announcement::latest()->get();
        return view('news.index', compact('announcements'));
    }

    public function store (Request $request) {
        $data = $request->validate([
            'subject' => 'required',
            'body' => 'required',
        ]);

        Announcement::create($data);
        return back()->withSuccess('Record has been submitted!');
    }
}
