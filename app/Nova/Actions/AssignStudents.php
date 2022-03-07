<?php

namespace App\Nova\Actions;

use App\Models\StudentParent;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignStudents extends Action
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
        foreach ($models as $m) {
            if (StudentParent::whereStudentId($fields['student_id'])->whereParentId($m->id)->count()) {
                continue; // will skip if has records
            }
            $m->students()->create([
                'student_id' => $fields['student_id'],
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
            Select::make('Student', 'student_id')
                ->rules(['required'])
                ->options(User::whereType(User::TYPE_STUDENT)->get()->pluck('name', 'id')),
        ];
    }
}
