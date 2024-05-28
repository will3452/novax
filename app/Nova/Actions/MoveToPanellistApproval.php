<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class MoveToPanellistApproval extends Action
{
    use InteractsWithQueue, Queueable;

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
            foreach($model->panellists as $panel) {
                $title = $model->title->title; 
                $panel->task()->create([
                    'status' => 'PENDING', 
                    'user_id' => $panel->faculty_id, 
                    'description' => "You are invited to be one of the panelists of the group '$title'. as '$panel->type'.", 
                ]); 
            }
            $model->update(['status' => 'For Panel Approval']); 
        }
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
