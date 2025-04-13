<?php

namespace App\Nova\Actions;

use App\Models\Penalty;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Textarea;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPenalty extends Action
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
        foreach ($models as $m) {
            Penalty::create([
                'payment_schedule_id' => $m->id,
                'amount' => $fields->amount,
                'notes' => $fields->notes,
                'loan_id' => $m->loan_id,
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
            Currency::make('Amount')
                ->rules(['required']),
            Textarea::make('Notes')->rules(['required'])
        ];
    }
}
