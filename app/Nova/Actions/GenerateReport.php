<?php

namespace App\Nova\Actions;

use App\Models\OrderProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;

class GenerateReport extends Action
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
        return Action::redirect(route('report', ['to' => $fields['to'], 'from' => $fields['from'], 'cooperative' => $fields['cooperative'], 'category' => $fields['category']]));
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
            Select::make('Cooperative')
                ->options(OrderProduct::get()->pluck('cooperative', 'cooperative')),
            Select::make('Category')
                ->options(OrderProduct::get()->pluck('product_category', 'product_category')),
        ];
    }
}
