<?php

namespace App\Observers;

use App\Models\Ingredient;
use App\Models\IngredientInventory;

class IngredientInventoryObserver
{
    /**
     * Handle the IngredientInventory "created" event.
     *
     * @param  \App\Models\IngredientInventory  $ingredientInventory
     * @return void
     */
    public function created(IngredientInventory $ingredientInventory)
    {
        $i = Ingredient::find($ingredientInventory->ingredient_id);
        $current_qty = $i->current_qty;
        if ($ingredientInventory->type == "USAGE") {
            $current_qty -= $ingredientInventory->quantity;
        } else {
            $current_qty += $ingredientInventory->quantity;
        }

        $totalUsage = $i->inventories()->whereType('USAGE')->sum('quantity');

        $tp = $i->purchaseOrders()->sum('quantity');
        $opo = $tp - $current_qty;
        $td = $i->inventories()->whereType('USAGE')->avg('quantity') ?? 0;
        $dl = 0;
        if ($td != 0) {
            $dl = number_format($current_qty / $td, 2);
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

    /**
     * Handle the IngredientInventory "updated" event.
     *
     * @param  \App\Models\IngredientInventory  $ingredientInventory
     * @return void
     */
    public function updated(IngredientInventory $ingredientInventory)
    {
        //
    }

    /**
     * Handle the IngredientInventory "deleted" event.
     *
     * @param  \App\Models\IngredientInventory  $ingredientInventory
     * @return void
     */
    public function deleted(IngredientInventory $ingredientInventory)
    {
        //
    }

    /**
     * Handle the IngredientInventory "restored" event.
     *
     * @param  \App\Models\IngredientInventory  $ingredientInventory
     * @return void
     */
    public function restored(IngredientInventory $ingredientInventory)
    {
        //
    }

    /**
     * Handle the IngredientInventory "force deleted" event.
     *
     * @param  \App\Models\IngredientInventory  $ingredientInventory
     * @return void
     */
    public function forceDeleted(IngredientInventory $ingredientInventory)
    {
        //
    }
}
