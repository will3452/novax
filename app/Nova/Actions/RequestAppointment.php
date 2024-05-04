<?php

namespace App\Nova\Actions;

use App\Models\Booking;
use App\Models\Service;
use Michielfb\Time\Time;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestAppointment extends Action
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
        Booking::create([
            'reference' => Str::random(12), 
            'patient_id' => auth()->id(), 
            'date' => $fields['date'], 
            'time' => $fields['time'],
            'service_id' => $fields['service_id'], 
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
            Select::make('Service', 'service_id')
                ->options(Service::get()->pluck('name', 'id'))
        ];
    }
}
