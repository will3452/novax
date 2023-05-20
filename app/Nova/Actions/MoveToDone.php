<?php

namespace App\Nova\Actions;

use App\Models\Inventory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class MoveToDone extends Action
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
        foreach ($models as $model) {
            $model->load('productOrders.product');
            if ($model->status != 'DONE') {
                $model->update(['status' => 'DONE']);
                // update inventory
                foreach ($model->productOrders as $po) {
                    Inventory::create([
                        'product_id' => $po->product->id,
                        'cost' => $po->product->price * $po->quantity,
                        'qty' => $po->quantity,
                        'bound' => 'OUT',
                    ]);
                }

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
        return [];
    }
}
