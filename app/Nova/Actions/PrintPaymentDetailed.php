<?php

namespace App\Nova\Actions;

use App\Models\Branch;
use App\Models\PaymentMethod;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PrintPaymentDetailed extends Action
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
        return Action::redirect(route('print.payment-detailed', ['date' => $fields->date, 'branch_id' => $fields->branch_id, 'payment_method' => $fields->payment_method]));
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
                Select::make('Payment Method', 'payment_method')
                    ->options(fn () => PaymentMethod::get()->pluck('name', 'name')),
                Date::make('Date')->rules(['required']),
        ];
    }
}
