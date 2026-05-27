<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;

class ResetStockout extends Action
{
    use InteractsWithQueue, Queueable;

     /* The text to be used for the action's confirmation message.
     */
    public $confirmText = "Would you like to set all stockout values to 0?";

    /**
     * The text to be used for the action's confirm button.
     */
    public $confirmButtonText = 'Continue';

    public $name = 'Reset Stockout';

    public function handle(ActionFields $fields, Collection $models)
{
    foreach ($models as $model) {
        $model->stockout = 0;
        $model->save();
    }

    return Action::message('Stockout reset successfully.');
}
}
