<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Story;
use App\Models\Question;
use App\Models\Scene;
use Illuminate\Http\Request;

class StoryModeController extends Controller
{
    public function index (Request $request) {
        $title = $request->keyword;
        $userAdmins = User::whereType('ADMIN')->get()->pluck('id')->all();

        $adminStories = Story::whereIn('user_id', $userAdmins)->where('title', 'LIKE', "%$title%")->latest()->get();
        $otherStories = Story::whereNotIn('user_id', $userAdmins)->where('title', 'LIKE', "%$title%")->latest()->get();
        // $adminScenes = Scene::whereIn('id', $userAdmins)->where('title', 'LIKE', "%$title%")->latest()->get();
        // $otherScenes = Scene::whereNotIn('id', $userAdmins)->where('title', 'LIKE', "%$title%")->latest()->get();

        $adminScenes = [];

        $otherScenes = [];

        return view('story_index', compact('adminStories', 'otherStories', 'adminScenes', 'otherScenes'));
    }

    public function show(Story $story) {
        return view('story_show', compact('story'));
    }

    public function quiz(Story $story) {
        $questions = Question::whereStoryId($story->id)->get();
        return view('quiz_index', compact('questions', 'story'));
    }
}
