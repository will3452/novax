<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class SetVerdict extends Action
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
            $model->update(['verdict' => $fields->verdict]); 
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
            Select::make('verdict')
                ->options([
                    'Approved with no revisions' => 'Approved with no revisions',
                    'Approved with minor revisions' => 'Approved with minor revisions', 
                    'Approved with major revisions' => 'Approved with major revisions', 
                    'Disapproved' => 'Disapproved', 
                    'For re-defense' => 'For re-defense', 
                ])
        ];
    }
}
