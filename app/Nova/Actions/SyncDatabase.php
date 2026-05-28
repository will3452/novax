<?php

namespace App\Nova\Actions;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SyncDatabase extends Action
{
    use InteractsWithQueue, Queueable;

    /* The text to be used for the action's confirmation message.
     */
    public $confirmText = "Would you like to update inventory content ENTIRELY?";

    /**
     * The text to be used for the action's confirm button.
     */
    public $confirmButtonText = 'Continue';

    public function parseCurrency(string $value): int
    {
        $clean = preg_replace("/[^\d.]/", "", $value);
        return (int) floatval($clean);
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
        $rows = app(\App\Services\GoogleSheetService::class)->getRows("A2:K");

        $products = [];
        $NAME = 2;
        $PRICE = 10;
        $CATEGORY = 8;
        $SHEET_ID = 0;
        $CARD_SET_CATEGORY = 4;
        $SEARCH_KEYWORD = 5;
        $RARITY = 6;
        $IMAGE = 1;
        $CARD_TREATMENT = 3;
        foreach ($rows as $row) {
            // check if all indexes is not empty
            if (
                empty($row[$NAME]) ||
                empty($row[$PRICE]) ||
                empty($row[$CATEGORY]) ||
                empty($row[$SHEET_ID]) ||
                empty($row[$CARD_SET_CATEGORY]) ||
                empty($row[$SEARCH_KEYWORD]) ||
                empty($row[$IMAGE])
            ) {
                continue;
            }
             $product = Product::where("sheet_id", $row[$SHEET_ID])->first();

            $defaultStock = $product ? $product->default_stock : 100;
            $p = [
                "name" => $row[$NAME] ?? 'N/a',
                "price" => $this->parseCurrency($row[$PRICE]),
                "category" => $row[$CATEGORY],
                "sheet_id" => $row[$SHEET_ID],
                "card_set_category" => $row[$CARD_SET_CATEGORY],
                "search_keyword" => $row[$SEARCH_KEYWORD],
                "image" => $row[$IMAGE],
                "rarity" => $row[$RARITY] ?? null,
                "card_set_treatment" => $row[$CARD_TREATMENT] ?? null,
                "default_stock" => $defaultStock,
                "current_stock" => $defaultStock,
                "remarks" => null,
            ];

            // push the product to the array
            //
            Product::updateOrCreate(["sheet_id" => $p["sheet_id"]], $p);
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
