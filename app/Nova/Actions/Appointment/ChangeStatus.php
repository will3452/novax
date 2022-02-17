<?php

namespace App\Nova\Actions\Appointment;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class ChangeStatus extends Action
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
        $models->each(function ($model) use ($fields) {
            $model->update(['status' => $fields['status']]);
        });
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Status')
                ->options([
                    Appointment::STATUS_APPROVED => Appointment::STATUS_APPROVED,
                    Appointment::STATUS_COMPLETED => Appointment::STATUS_COMPLETED,
                    Appointment::STATUS_PENDING => Appointment::STATUS_PENDING,
                ])->rules(['required']),
        ];
    }
}
