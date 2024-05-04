<?php

namespace App\Nova\Actions;

use App\Models\Booking;
use Michielfb\Time\Time;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookService extends Action
{
    use InteractsWithQueue, Queueable;

    public function shownOnTableRow()
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
        $model = $models[0]; 
        Booking::create([
            'reference' => Str::random(12), 
            'patient_id' => auth()->id(), 
            'date' => $fields['date'], 
            'time' => $fields['time'],
            'service_id' => $model->id, 
        ]);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Date::make('Date')->rules(['required', 'date', 'after_or_equal:today']), 
            Time::make('Time', 'time')->withSteps(1)->rules(['required']), 
        ];
    }
}
