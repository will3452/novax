<?php

namespace App\Nova\Actions;

use App\Models\Task;
use App\Models\Group;
use App\Models\Progress;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproveTask extends Action
{
    use InteractsWithQueue, Queueable;

    public $showOnTableRow = true; 
    public $task; 
    public function __construct(Task $task)
    {
        $this->task = $task;    
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach($models as $model) {
            // dd($this->task->task); 
            $model->update(['status' => 'APPROVED']); 
            // if (auth()->user()->type == \App\Models\User::TYPE_DEAN) {
            if ($this->task->task->status == 'For Coordinator Approval' && $model->task_type != "App\Models\Progress") {
                $model->task()->update(['code' => $fields['code']]); 
            }

            if ($model->task_type == "App\Models\Progress" && $this->task->task->status == 'For Adviser Approval') {
                Task::create([
                    'task_type' => $model->task_type, 
                    'task_id' => $model->task_id,  
                    'user_id' => nova_get_setting('coordinator_id'), 
                    'description' => "New progress report of " . $model->task->group->code, 
                    'approved_status' => Progress::APPROVED, 
                ]); 
            }

            if ($model->task_type == "App\Models\Progress" && $this->task->task->status == 'For Coordinator Approval') {
                Progress::whereGroupId($model->task->group_id)->update([
                    'is_ready_for_oral_def' => true, 
                ]); 
            }

            if ($model->task_type == "App\Models\OralDefenseRequest") {
                $approved = Task::whereTaskType("App\Models\OralDefenseRequest")->whereTaskId($model->task_id)->whereStatus('APPROVED')->count(); 
                $total = Task::whereTaskType("App\Models\OralDefenseRequest")->whereTaskId($model->task_id)->count(); 

                if ($total == $approved && $approved > 0) {
                    $group = Group::find($model->task->group_id); 
                    
                    $date = $model->task->date->format('M d, Y'); 
                    $venue = $model->task->venue; 
                    $time = $model->task->time; 

                    if ($model->task->status == 'Panelist Approval') {
                        $model->task()->update(['status' => 'Coordinator Approval']); 
                        
                        
                        $model->task->tasks()->create([
                            'user_id' => nova_get_setting('coordinator_id', 1), 
                            'description' => "The group $group->code is requesting to schedule their oral defense on $date, at $time in $venue. "
                        ]); 
                        return; 
                    }

                    $model->task()->update(['status' => $model->approved_status]); 
                    $group->update(['defense_schedule' => $date]);
                    \App\Models\Event::create([
                        'title' => $group->code. " Defense @ $venue", 
                        'start' => Carbon::parse($date)->setTimeFromTimeString($time),
                        'end' => Carbon::parse($date)->addHours(2), 
                    ]); 
                    return Action::message('Event created successfully!'); 
                }   

                
                return; 
                
            }
            $model->task()->update(['status' => $model->approved_status]); 
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        $fields = [];
        // if ( auth()->user()->type == \App\Models\User::TYPE_DEAN ) {
        // if ( true) {
        if ( $this->task->task->status == 'For Coordinator Approval' && $this->task->task_type != "App\Models\Progress") {
            array_push($fields, Text::make('Group Code', 'code')
                ->default(function () {
                    $year = nova_get_setting('school_year');
                    $ps = $this->task->task->title->titleApplications()->first()->student->course; 
                    $sq = Group::whereNotNull('code')->count() + 1; 
                    return "$year-$ps-$sq"; 
                })
                ->rules(['required'])); // todo: modify fields to become dynamic 
        }
        return $fields;
    }
}
