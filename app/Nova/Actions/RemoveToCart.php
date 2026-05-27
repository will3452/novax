<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Facades\DB;
use App\Models\InventoryAudit;
use Illuminate\Support\Facades\Auth;

class RemoveToCart extends Action
{
    
    use InteractsWithQueue, Queueable;

    public $name = 'Cancel Order';

    public $destructive = true;

    public $confirmText = 'Would you like to cancel your order?';

    public $confirmButtonText = 'Continue';

    public function shownOnTableRow()
    {
        return true;
    }

    public function actionClass()
{
    return 'btn btn-danger';
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
    return DB::transaction(function () use ($models) {

        $pendingOrder = \App\Models\Order::where('employee_id', auth()->id())
            ->where('status', \App\Models\Order::STATUS_PENDING)
            ->first();

        if (!$pendingOrder) {
            return Action::danger('No pending order found.');
        }

        foreach ($models as $model) {

            InventoryAudit::create([
                'product_id' => $model->id,
                'user_id' => Auth::id(),
                'card_name' => $model->name ?? 'Deleted Product',
                'action' => 'order_canceled'
            ]);

            $orderItem = \App\Models\OrderItem::where('order_id', $pendingOrder->id)
                ->where('product_id', $model->id)
                ->first();

            if ($orderItem) {

                $qty = $orderItem->qty;

// Restore stock
$model->current_stock += $qty;

// Reduce stockout
$model->stockout -= $qty;

// Safety protections
if ($model->stockout < 0) {
    $model->stockout = 0;
}

if ($model->current_stock > $model->default_stock) {
    $model->current_stock = $model->default_stock;
}

$model->save();

                // Remove item from the order
                $orderItem->delete();
            }
        }

        // Delete order if empty
        if ($pendingOrder->orderItems()->count() === 0) {
            $pendingOrder->delete();
        }

        return Action::message('Order cancelled successfully.');
    });
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
