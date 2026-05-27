<?php

namespace App\Nova\Actions;

use App\Services\GoogleSheetService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Fields\ActionFields;

class SyncProducts extends Action
{
    use InteractsWithQueue, Queueable;

    /* The text to be used for the action's confirmation message.
     */
    public $confirmText = "Would you like to update the product(s)?";

    /**
     * The text to be used for the action's confirm button.
     */
    public $confirmButtonText = 'Continue';


    public function handle(ActionFields $fields, Collection $models)
{
    $service = app(GoogleSheetService::class);

    foreach ($models as $product) {

        // Sync product data from sheet
        $service->syncSingleProduct($product);

        // Reset current stock based on default stock
        $product->current_stock = $product->default_stock;
        $product->save();
        
    }

    return Action::message('Selected products synced successfully!');
}
}