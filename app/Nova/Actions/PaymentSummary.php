<?php

namespace App\Nova\Actions;

use App\Models\Brand;
use App\Models\Branch;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Date;

class PaymentSummary extends Action
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
        return Action::redirect(route('print.payment-summary', ['from' => $fields->from, 'to' => $fields->to, 'branch_id' => $fields->branch_id]));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
                Select::make('Branch', 'branch_id')
                    ->options(fn () => Branch::get()->pluck('name', 'id')),
                Date::make('From')->rules(['required']),
                Date::make('To')->rules(['required']),
            ];
    }
}
