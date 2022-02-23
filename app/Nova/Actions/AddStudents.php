<?php

namespace App\Nova\Actions;

use App\Models\StudentRoom;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use OptimistDigital\MultiselectField\Multiselect;

class AddStudents extends Action
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
        $students = $fields['students'];
        $studentIds = preg_split("/[\]\[,\"\s]/", $students);

        foreach ($models as $model) {
            foreach ($studentIds as $studentId) {
                if ($studentId != "") {
                    StudentRoom::create([
                        'student_id' => $studentId,
                        'room_id' => $model->id,
                    ]);
                }

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
            Multiselect::make('students', 'students')
                ->options(
                    \App\Models\User::whereType(
                        \App\Models\User::TYPE_STUDENT
                    )->whereDoesntHave('classRoom')
                    ->pluck('name', 'id')
                )
        ];
    }
}
