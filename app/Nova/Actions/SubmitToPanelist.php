<?php

namespace App\Nova\Actions;

use App\Models\Group;
use App\Models\OralDefenseRequest;
use App\Models\Section;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class SubmitToPanelist extends Action
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
            $group = Group::find($model->group_id); 
            $model->update(['section_id' => $group->title->section_id, 'status' => OralDefenseRequest::PANELIST_APPROVAL]); 
            
            $panelists = $group->panellists; 
            $date = $model->date->format('M d, Y'); 
            foreach($panelists as $p) {
                $model->tasks()->create([
                    'user_id' => $p->faculty_id, 
                    'description' => "The group $group->code is requesting to schedule their oral defense on $date, at $model->time in $model->venue. "
                ]); 
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        
        return [
        ];
    }
}
