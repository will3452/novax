<?php

namespace App\Nova\Actions;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class CreateGroupFromThisTitle extends Action
{
    use InteractsWithQueue, Queueable;

    
    public $confirmText = 'Are you sure you want to create group from this title, all application with approved status will automatically added as member of the group.';

    public $confirmButtonText = 'Create Group now';

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
            $model->update(['status' => 'Taken']); 
            $exists = Group::whereTitleId($model->id)->exists(); 
            if ($exists) return Action::danger('Group is already existing'); 
            $approvedMembers = \App\Models\TitleApplication::whereTitleId($model->id)->whereStatus('APPROVED')->count();
            if ($model->no_of_students != $approvedMembers) {
                return Action::danger('Number of approved student application is not match to the title\'s required no. of student.'); 
            } 
            $group = Group::create([
                'title_id' => $model->id, 
                'status' => Group::ADD_PANELIST, 
            ]); 

            foreach(\App\Models\TitleApplication::whereTitleId($model->id)->whereStatus('APPROVED')->get() as $application) {
                GroupMember::create([
                    'group_id' => $group->id, 
                    'student_id' => $application->student_id,
                ]); 
            }
        }

        return Action::message('Group has been created!'); 
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
