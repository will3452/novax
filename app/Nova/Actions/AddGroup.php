<?php

namespace App\Nova\Actions;

use App\Models\UserLoan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class AddGroup extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = "Add Group Borrower";

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $group = \App\Models\Group::find($fields->group);
        foreach ($models as $model) {
            foreach ($group->groupMembers as $member) {
                UserLoan::create([
                    'loan_id' => $model->id,
                    'group_id' => $group->id,
                    'user_id' => $member->id
                ]);
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
            Select::make('Group', 'group')
                ->options(\App\Models\Group::get()->pluck('name', 'id')),
        ];
    }
}
