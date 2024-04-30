<?php

namespace App\Nova\Actions;

use App\Models\Attendance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class MarkAsPresentToday extends Action
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
            $exists = Attendance::whereDate('created_at', now())->whereTraineeId($model->id)->exists(); 
            if ($exists) continue; 
            Attendance::create([
                'trainee_id' => $model->id, 
                'hte_id' => auth()->id(),
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
        return [];
    }
}
