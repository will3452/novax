<?php

namespace App\Nova\Actions;

use App\Models\OralDefenseRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Michielfb\Time\Time;

class EndorseGroup extends Action
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
            $model->update(['status' => \App\Models\Group::READY_FOR_DEFENSE]);
            OralDefenseRequest::create([
                'group_id' => $model->id, 
                'time' => $fields->time, 
                'date' => $fields->date, 
                'venue' => $fields->venue, 
                'status' => OralDefenseRequest::SUBMIT_ORAL_DEFENSE, 
            ]); 
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
            Date::make('Preferred Schedule', 'date')->rules(['required']), 
            Time::make('Time'), 
            Text::make('Venue'), 
        ];
    }
}
