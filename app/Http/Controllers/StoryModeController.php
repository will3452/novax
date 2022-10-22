<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryModeController extends Controller
{
    public function index (Request $request) {
        $title = $request->keyword;
        $stories = Story::where('title', 'LIKE', "%$title%")->latest()->simplePaginate(10);
        return view('story_index', compact('stories'));
    }

    public function show(Story $story) {
        return view('story_show', compact('story'));
    }

    public function quiz(Story $story) {
        $questions = Question::whereStoryId($story->id)->get();
        return view('quiz_index', compact('questions'));
    }
}
