<?php

namespace App\Nova\Actions;

use App\Models\Inventory;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmTransaction extends Action
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
            if ($model->status == 'CONFIRMED') continue;
            $model->update(['status' => 'CONFIRMED']);

            $items = $model->items;
            foreach ($items as $item) {
                if ($item->salable_type != "App\Models\Product") continue;
                $i = Inventory::whereProductId($item->salable_id)
                    ->whereBranchId($model->branch_id)
                    ->first();
                if ($i) {
                    $i->update(['qty' => $i->qty - $item->qty]);
                } else {
                    Inventory::create([
                        'branch_id' => $model->branch_id,
                        'product_id' => $item->salable_id,
                        'qty' => - $item->qty,
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
