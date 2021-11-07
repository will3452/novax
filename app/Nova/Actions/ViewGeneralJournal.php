<?php

namespace App\Nova\Actions;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ViewGeneralJournal extends Action
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
        $start_date = Carbon::parse($fields->from)
        ->toDateTimeString();

        $end_date = Carbon::parse(request()->to)
                ->toDateTimeString();

        return Action::openInNewTab("/general-grournal?from=$start_date&to=$end_date");
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Date::make('From Date', 'from')
                ->rules('required'),
            Date::make('to Date', 'to')
                ->rules('required'),
        ];
    }
}
