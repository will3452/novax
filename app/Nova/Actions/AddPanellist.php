<?php

namespace App\Nova\Actions;

use App\Models\Panellist;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class AddPanellist extends Action
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
        foreach($models as $model) {
            $exists = Panellist::whereFacultyId($fields['faculty_id'])->whereGroupId($model->id)->exists();

            if ($exists) return Action::danger('Faculty has already been added!'); 
            Panellist::create([
                'group_id' => $model->id,
                'faculty_id' => $fields['faculty_id'], 
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
            Select::make('Panellist', 'faculty_id')
                ->options(User::whereType(User::TYPE_FACULTY)->get()->pluck('name', 'id'))
                ->searchable(),
        ];
    }
}
