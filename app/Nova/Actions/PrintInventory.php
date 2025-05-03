<?php

namespace App\Nova\Actions;

use App\Models\Branch;
use App\Models\Brand;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PrintInventory extends Action
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
        return Action::openInNewTab(route('print.inventory', ['branch_id' => $fields->branch_id, 'brand_id' => $fields->brand_id]));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Branch', 'branch_id')
                ->options(fn () => Branch::get()->pluck('name', 'id')),
            Select::make('Brand', 'brand_id')
                ->options(fn () => Brand::get()->pluck('name', 'id')),
            ];
    }
}
