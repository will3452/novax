<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Number;

class AddToCart extends Action
{
    use InteractsWithQueue, Queueable;

    public function shownOnTableRow()
    {
        return true;
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
    */
    public function handle(ActionFields $fields, Collection $models)
    {
        $order = \App\Models\Order::firstOrCreate(
            ['employee_id' => auth()->user()->id, 'status' => \App\Models\Order::STATUS_PENDING],
            ['employee_id' => auth()->user()->id, 'status' => \App\Models\Order::STATUS_PENDING]
        );
        foreach ($models as $model) {
            \App\Models\OrderItem::firstOrCreate(['order_id' => $order->id,
                'product_id' => $model->id], [
                'order_id' => $order->id,
                'product_id' => $model->id,
                'qty' => $fields->qty,
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
            Number::make('Quantity', 'qty')
                ->min(1)
                ->step(1)
                ->default(1)
                ->rules('required', 'integer', 'min:1'),
        ];
    }
}
