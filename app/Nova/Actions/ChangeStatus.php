<?php

namespace App\Nova\Actions;

use App\Mail\AppointmentStatusUpdate;
use App\Notifications\CancelledAppointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
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
        foreach ($models as $model) {
            $email = $model->patient->email;
            $model->update(['status' => $fields['status']]);
            $status = $fields['status'];
            Mail::to($email)->send(new AppointmentStatusUpdate($model, $status));
            if ($status == 'Cancelled') {
                $model->patient->notify(new CancelledAppointment($model));
            }
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
            Select::make('Status')
                ->options([
                    'Finished' => 'Finished',
                    'For Approval' => 'For Approval',
                    'Approved' => 'Approved',
                    'Cancelled' => 'Cancelled',
                    'Rejected' => 'Rejected',
                ])
        ];
    }
}
