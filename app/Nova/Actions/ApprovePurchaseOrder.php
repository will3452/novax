<?php

namespace App\Nova\Actions;

use App\Models\Inventory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ApprovePurchaseOrder extends Action
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
            if ($model->status == 'APPROVED') continue;

            $model->update(['status' => 'APPROVED']);


            // create supplier billing


            $items = $model->items;
            foreach ($items as $item) {
                $i = Inventory::whereProductId($item->product_id)
                    ->whereBranchId($model->branch_id)
                    ->first();
                if ($i) {
                    $i->update(['qty' => $i->qty + $item->qty]);
                } else {
                    Inventory::create([
                        'branch_id' => $model->branch_id,
                        'product_id' => $item->product_id,
                        'qty' => $item->qty,
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
