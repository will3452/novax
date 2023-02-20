<?php

namespace App\Nova\Actions;

use App\Models\Booking;
use App\Models\RoomStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

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
            $existing = RoomStudent::whereStudentId($fields['student_id'])->whereRoomId($model->id)->exists();
            if (! $existing) {
                RoomStudent::create([
                    'student_id' => $fields['student_id'],
                    'room_id' => $model->id,
                ]);
            } else {
                return Action::danger('Already existed!');
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
            Select::make('Student', 'student_id')
                ->options(\App\Models\User::whereType(\App\Models\User::TYPE_STUDENT)->get()->pluck('name', 'id'))
        ];
    }
}
