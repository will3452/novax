<?php

namespace App\Nova\Actions;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Textarea;

class Notifify extends Action
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

        Appointment::where(['alert' => 1])->update(['alert' => 0]);

        foreach($models as $model) {
            Mail::raw($fields['message'], function ($message) use ($model) {
                $message->to($model->user->email)->subject('RHU: Alert');
            });

            $model->update(['alert' => 1, 'description_1' => $fields['message']]);
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
            Textarea::make("message")->rules(['required']),
        ];
    }
}
