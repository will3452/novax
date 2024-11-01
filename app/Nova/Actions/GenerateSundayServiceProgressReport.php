<?php

namespace App\Nova\Actions;

use App\Models\ReportLog;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateSundayServiceProgressReport extends Action
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
        ReportLog::create([
            'prepared_by' => auth()->user()->name,
            'date' => now(),
            'type' => 'SUNDAY_PROGRESS_REPORT',
        ]);
        $year = \Carbon\Carbon::parse($fields->date)->year;
        $month = \Carbon\Carbon::parse($fields->date)->month;
        return Action::openInNewTab("/progress-report?year=$year&month=$month");
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Date::make('date'),
        ];
    }
}
