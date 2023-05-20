<?php

namespace App\Nova\Actions;

use App\Models\Department;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class AssignToDepartment extends Action
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
        $modelType = explode('\\', get_class($models[0]))[2];
        $field = strtolower($modelType) . '_id';
        foreach ($models as $model) {
            $task = Task::where($field, $model->id)->first();
            if ($task) {
                $task->update(['department_id' => $fields['department']]);
            } else {
                Task::create([
                    $field => $model->id,
                    'department_id' => $fields['department'],
                    'status' => Task::STATUS_FOR_APPROVAL,
                    'created_by' => auth()->id(),
                ]);
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
            Select::make('Department')
                ->options(Department::get()->pluck('name', 'id')),
        ];
    }
}
