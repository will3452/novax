<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $pending = Todo::whereUserId(auth()->id())
            ->whereStatus(Todo::STATUS_PENDING)
            ->latest()->get();
        $done = Todo::whereUserId(auth()->id())
            ->whereStatus(Todo::STATUS_DONE)
            ->latest()->get();
        return view('todo_index', compact('pending', 'done'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
        ]);

        $data['user_id'] = auth()->id();

        Todo::create($data);

        return back()->withAlert('Success!');
    }

    public function markAsComplete(Todo $todo)
    {
        $todo->markAsDone();

        return back()->withAlert('Success');
    }
}
