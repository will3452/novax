<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Task;
use App\Models\User;
use App\Models\Group;
use App\Notifications\GroupForDefenseNotification;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index () {
        return view('tasks.index');
    }

    public function isTitleApproval($task) {
        return $task->task_type == "App\Models\Title";
    }

    public function isTitleApplicationApproval($task) {
        return $task->task_type == "App\Models\TitleApplication";
    }

    public function isGroupApproval($task) {
        return $task->task_type == "App\Models\Group";
    }

    public function isProgressApproval($task) {
        return $task->task_type == "App\Models\Progress";
    }


    public function approve(Request $request, Task $task) {
         $task->update(['status' => 'APPROVED']);

        if ($this->isProgressApproval($task)) {
            if ($task->approved_status == "For Coordinator Approval") {
                $task->task->task()->create([
                    'user_id' => nova_get_setting('coordinator_id', 1),
                    'description' => $task->description,
                    'approved_status' => 'Approved',
                ]);
            }
        }

        if ($this->isTitleApplicationApproval($task)) {
            $group = Group::whereTitleId($task->task->title_id)->first();
            $group->groupMembers()->create([
                'student_id' => $task->task->student_id,
                'group_id' => $group->id,
            ]);
        }

        if ($this->isGroupApproval($task)) {
            if ($task->approved_status == 'For Dean Approval') {
                $task->task->task()->create([
                    'user_id' => nova_get_setting('dean_id', User::whereType('Dean')->first()->id ?? 1),
                    'description' => $task->description,
                    "approved_status" => 'Ongoing',
                ]);
            }

            if ($task->approved_status == 'Ready for defense(Coordinator approval)') {
                $totalApprovers = Task::whereTaskId($task->task_id)->whereTaskType($task->task_type)->whereApprovedStatus('Ready for defense(Coordinator approval)')->count();
                $approved = Task::whereTaskId($task->task_id)->whereTaskType($task->task_type)->whereApprovedStatus('Ready for defense(Coordinator approval)')->whereStatus('APPROVED')->count();

                if ($totalApprovers != $approved) {
                    alert()->success('Success', "Task has been approved!");
                    return back();
                } else {
                    $group = $task->task->title->group;
                    $group->task()->create([
                        'user_id' => nova_get_setting('coordinator_id', 1),
                        'description' => $task->description,
                        'approved_status' => 'Ready for defense',
                    ]);

                }
            }

            if ($task->approved_status == 'Ready for defense') {
                $group = $task->task->title->group;
                foreach ($group->groupMembers as $g) {
                    User::find($g->student_id)->notify(new GroupForDefenseNotification($group));
                }

                $date =  $task->task->oralDefenseRequests()
                    ->whereStatus('Panelist Approval')
                    ->latest()->first();

                $group->update(['defense_schedule' => $date->date]);

                Event::create([
                    'title' => "Group: $group->code",
                    'start' => $date->date,
                    'end' => $date->$date,
                ]);
            }
        }

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
