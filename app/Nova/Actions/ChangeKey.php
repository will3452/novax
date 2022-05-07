<?php

namespace App\Nova\Actions;

use App\Models\Role;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeKey extends Action
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
        $key = $fields['key'];
        foreach ($models as $model) {

            if (! auth()->user()->hasRole(Role::SUPERADMIN)) {
                $model->update(['opened_at' => now()]);
            }
            return Action::openInNewTab("/change-key?model=$model->id&key=$key");
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
            Text::make('key')
            ->rules(['required']),
        ];
    }
}
