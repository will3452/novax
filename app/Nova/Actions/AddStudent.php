<?php

namespace App\Nova\Actions;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\BelongsToMany;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddStudent extends Action
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
            if($model->students()->where('student_id', $fields['student'])->count()) {
                return Action::danger('Student was already added!');
            }
            $model->students()->attach($fields['student']);
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
            Select::make('Student')
                ->help('Enter Student No.')
                ->searchable()
                ->options(Student::get()->pluck('student_number', 'id'))
                ->required(),
        ];
    }
}
