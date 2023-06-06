<?php

namespace App\Nova\Actions;

use App\Mail\BookingApproved;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class Approve extends Action
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
        // Notifications TODO
        foreach ($models as $model) {
            $queue = Appointment::whereDate('date', Carbon::parse($model->date))->whereNotNull('approved_at')->count() + 1;
            $model->approved();
            $userName = $model->user->first_name;
            Mail::to($model->user)->send(new BookingApproved($model, $model->user));
        }
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
