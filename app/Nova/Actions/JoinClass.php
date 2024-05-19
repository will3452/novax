<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class JoinClass extends Action
{
    use InteractsWithQueue, Queueable;

    public $showOnTableRow = true;

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
            if (Hash::check($fields->pass_code, $model->section->pass_code)) {
                $model->update(['status' => 'JOINED']); 
                return Action::message("You've joined successfully!"); 
            } else {
                    return Action::danger('Incorrect Passcode!');
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
            Text::make('Passcode', 'pass_code'), 
        ];
    }
}
