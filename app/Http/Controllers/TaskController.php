<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index () {
        return view('tasks.index');
    }

    public function isTitleApproval($task) {
        return $task->task_type == "App\Models\Title";
    }

    public function approve(Request $request, Task $task) {
        $task->update(['status' => 'APPROVED']);

        if ($this->isTitleApproval($task)) {
            $title = $task->task;
            if ($task->approved_status == "FOR DEAN APPROVAL") {
                $task->task->task()->create([
                    'user_id' => User::whereType('Dean')->first()->id ?? 1,
                    'description' => "[Dean] New Title \"$title->title\" has been created.",
                    'approved_status' => "APPROVED",
                ]);
            }
        }

        $task->task()->update(['status' => $task->approved_status]);
        alert()->success('Success', "Task has been approved!");
        return back();
    }
}
