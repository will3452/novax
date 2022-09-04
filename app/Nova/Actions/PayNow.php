<?php

namespace App\Nova\Actions;

use App\Services\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class PayNow extends Action
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
        if (is_null($models[0]->approved_at)) {
            return Action::danger('Appointment is not yet approved!');
        }

        if (! is_null($models[0]->paid_at)) {
            return Action::danger('Appointment is paid!');
        }
        return Action::redirect('/paynow?appointment=' . $models[0]->id);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
