<?php

namespace App\Nova\Actions;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use App\Models\ApplicationLog;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MarkAsDone extends Action
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
            $model->update(['status' => Application::STATUS_DONE]);

            ApplicationLog::create([
                'application_id' => $model->id,
                'remarks' => $fields['remarks'],
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
        return [Text::make('Remarks/Reason', 'remarks'),];
    }
}
