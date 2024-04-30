<?php

namespace App\Nova\Actions;

use App\Models\VisitLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Textarea;

class MarkAsVisited extends Action
{
    use InteractsWithQueue, Queueable;

    public function shownOnTableRow()
    {
        return true; 
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach($models as $model) {
            $exists = VisitLog::whereDate('created_at', now())->whereTraineeId($model->id)->exists(); 
            if ($exists) continue; 
            VisitLog::create([
                'coordinator_id' => auth()->id(),
                'trainee_id' => $model->id, 
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
        return [
            Textarea::make('Remarks')->rules(['required']), 
        ];
    }
}
