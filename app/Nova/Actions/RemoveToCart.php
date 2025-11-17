<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class RemoveToCart extends Action
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
        foreach ($models as $model) {
            \App\Models\OrderItem::where('order_id', function ($query) {
                $query->select('id')
                    ->from('orders')
                    ->where('employee_id', auth()->user()->id)
                    ->where('status', \App\Models\Order::STATUS_PENDING)
                    ->limit(1);
            })->where('product_id', $model->id)->delete();
        }
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
