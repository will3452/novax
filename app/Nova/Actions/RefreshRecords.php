<?php

namespace App\Nova\Actions;

use App\Models\Product;
use App\Models\Ingredient;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshRecords extends Action
{
    use InteractsWithQueue, Queueable;

    public $type;

    public function __construct($type)
    {
        $this->type = $type;
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
        if ($this->type == "PRODUCT") {
            $ps = Product::get();
            foreach ($ps as $p) {
                $adj = $p->inventories()->whereType('ADJUSTMENT')->sum('quantity');
                $orders = $p->inventories()->whereType('ORDER')->sum('quantity');
                $p->update(['ci' => $adj - $orders]);

                // qty sell
                $p->update(['qty_sell' => $orders]);
            }
        } else {
            $ingredients = Ingredient::get();
            foreach ($ingredients as $i) {
                $totalUsage = $i->inventories()->whereType('USAGE')->sum('quantity');
                $totalPurchase = $i->inventories()->whereType('PURCHASE')->sum('quantity');
                $current_qty = $totalPurchase - $totalUsage;
                $tp = $i->purchaseOrders()->sum('quantity');
                $opo = $tp - $current_qty;
                $td = $i->inventories()->whereType('USAGE')->avg('quantity') ?? 0;
                $dl = 0;
                if ($td != 0) {
                    $dl = $current_qty / $td;
                }
                $i->update([
                    'current_qty' => $current_qty,
                    'opo' => $opo,
                    'tp' => $tp,
                    'tu' => $totalUsage,
                    'td' => $td,
                    'dl' => $dl,
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
        return [];
    }
}
