<?php

namespace App\Nova\Actions\JobApplication;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;

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
            $model->update([
                'status'=>$fields->status
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
            Select::make('Status')
                ->options([
                    JobApplication::STATUS_ACCEPTED => JobApplication::STATUS_ACCEPTED,
                    JobApplication::STATUS_DECLINED => JobApplication::STATUS_DECLINED,
                    JobApplication::STATUS_INTERVIEW => JobApplication::STATUS_INTERVIEW,
                ])
                ->rules(['required']),

            Textarea::make('Message')
                ->help('Simple message for the applicant'),
        ];
    }
}
