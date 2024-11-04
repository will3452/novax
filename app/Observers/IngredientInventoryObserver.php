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
        if ($ingredientInventory->type == "USAGE") {
            $i->current_qty -= $ingredientInventory->quantity;
        } else {
            $i->current_qty += $ingredientInventory->quantity;
        }

        $i->save();
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
