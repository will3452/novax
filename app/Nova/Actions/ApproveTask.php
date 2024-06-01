<?php

namespace App\Nova\Actions;

use App\Models\Task;
use App\Models\Group;
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
            $model->update(['status' => 'APPROVED']); 
            if (auth()->user()->type == \App\Models\User::TYPE_DEAN) {
                $model->task()->update(['code' => $fields['code']]); 
            }

            if ($model->task_type == "App\Models\OralDefenseRequest") {
                $approved = Task::whereTaskType("App\Models\OralDefenseRequest")->whereTaskId($model->task_id)->whereStatus('APPROVED')->count(); 
                $total = Task::whereTaskType("App\Models\OralDefenseRequest")->whereTaskId($model->task_id)->count(); 

                if ($total == $approved && $approved > 0) {
                    $group = Group::find($model->task->group_id); 
                    
                    $date = $model->task->date->format('M d, Y'); 
                    if ($model->task->status == 'Panelist Approval') {
                        $model->task()->update(['status' => 'Coordinator Approval']); 
                        
                        
                        $venue = $model->task->venue; 
                        $time = $model->task->time; 
                        $model->task->tasks()->create([
                            'user_id' => nova_get_setting('coordinator_id', 1), 
                            'description' => "The group $group->code is requesting to schedule their oral defense on $date, at $time in $venue. "
                        ]); 
                        return; 
                    }

                    $model->task()->update(['status' => $model->approved_status]); 
                    $group->update(['defense_schedule' => $date]); 
                    return; 
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
        if ( auth()->user()->type == \App\Models\User::TYPE_DEAN ) {
            array_push($fields, Text::make('Group Code', 'code')->rules(['required'])); // todo: modify fields to become dynamic 
        }
        return $fields;
    }
}
