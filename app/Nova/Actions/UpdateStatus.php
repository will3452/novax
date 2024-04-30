<?php

namespace App\Nova\Actions;

use App\Models\Application;
use App\Models\Supervision;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class UpdateStatus extends Action
{
    use InteractsWithQueue, Queueable;

    public function showOnTableRow()
    {
        return true; 
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
            $model->update(['status' => $fields['status']]); 
            if ($fields['status'] == 'APPROVED') {
                Supervision::create([
                    'head_id' => auth()->id(),
                    'member_id' => $model->trainee_id, 
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
            Select::make('status')
                ->options([
                    Application::STATUS_APPROVED => Application::STATUS_APPROVED,  
                    Application::STATUS_FOR_COMPLIANCES => Application::STATUS_FOR_COMPLIANCES,  
                    Application::STATUS_FOR_INTERVIEW => Application::STATUS_FOR_INTERVIEW,  
                    Application::STATUS_ONGOING => Application::STATUS_ONGOING,  
                    Application::STATUS_REJECTED => Application::STATUS_REJECTED,  
                ])
        ];
    }
}
