<?php

namespace App\Nova\Actions;

use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;

class GeneratePayroll extends Action
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
        $users = User::whereHas('position')->with('position')->get();
        foreach ($users as $user) {
            $attendances = Attendance::whereUserId($user->id)->whereBetween('created_at', [$fields['from'], $fields['to']])->get();

            $compensation = $user->position->daily_rate * count($attendances);

            Payroll::create([
                'user_id' => $user->id,
                'from' => $fields['from'],
                'to' => $fields['to'],
                'total' => $compensation,
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
            Date::make('From')
                ->rules(['required']),
            Date::make('To')
                ->rules(['required']),
        ];
    }
}
