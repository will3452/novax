<?php

namespace App\Nova\Actions;

use App\Models\UserLoan;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddBorrower extends Action
{
    use InteractsWithQueue, Queueable;
    public $name = "Add Individual Borrower";

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
            UserLoan::create([
                'loan_id' => $model->id,
                'user_id' => $fields->borrower,
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
            Select::make('Borrower', 'borrower')
                ->options(\App\Models\User::whereType('USER')->get()->pluck('name', 'id')),
        ];
    }
}
