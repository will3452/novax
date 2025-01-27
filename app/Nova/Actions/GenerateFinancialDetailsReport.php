<?php

namespace App\Nova\Actions;

use App\Models\ReportLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Carbon\Carbon;

class GenerateFinancialDetailsReport extends Action
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
            'type' => 'FINANCIAL_REPORT',
        ]);
        $year = Carbon::parse($fields->year)->year;
        $month = Carbon::parse($fields->year)->month;
        return Action::openInNewTab("/financial-details-report?year=$year&month=$month");
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Date::make('year'),
        ];
    }
}
