<?php

namespace App\Nova\Actions;

use App\Models\Attendance;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SubmitAttendanceToday extends Action
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
        $exists = Attendance::whereUserId(auth()->id())->whereDate('created_at', '=', now())->exists();
        if ($exists) {
            return Action::danger('You already submitted your attendance today!');
        }
        Attendance::create([
            'user_id' => auth()->id(),
        ]);
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
