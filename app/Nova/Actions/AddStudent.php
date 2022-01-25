<?php

namespace App\Nova\Actions;

use App\Models\User;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddStudent extends Action
{
    use InteractsWithQueue, Queueable;

    public function excludeId(): array
    {
        return UserCourse::whereCourseId(request()->resourceId)
            ->pluck('user_id')
            ->toArray();
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
        foreach ($models as $model) {
            UserCourse::addStudent($fields['user_id'], $model->id);
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
            Select::make('Student', 'user_id')
                ->options(User::students()->whereNotIn('id', $this->excludeId())->pluck('name', 'id'))
                ->rules(['required']),
        ];
    }
}
