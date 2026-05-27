<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Number;

class AddToCart extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Validate Order';

    public $confirmText = 'Would you like to verify the order?';

    public $confirmButtonText = 'Continue';

    public function shownOnTableRow()
    {
        return true;
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        $user = auth()->user();

        // 🔒 Block if no quota
        if ($user->quota <= 0) {
            return Action::danger('You do not have enough quota to validate this order.');
        }

        $requestedQty = max(1, (int) $fields->qty);

        // 1️⃣ PRE-CHECK: block if any product has no stock
        foreach ($models as $product) {
            if ((int) $product->current_stock <= 0) {
                return Action::danger("Cannot validate order: '{$product->name}' is out of stock.");
            }
        }

        // 2️⃣ Get or create pending order
        $order = \App\Models\Order::firstOrCreate(
            [
                'employee_id' => $user->id,
                'status' => \App\Models\Order::STATUS_PENDING
            ],
            [
                'employee_id' => $user->id,
                'status' => \App\Models\Order::STATUS_PENDING
            ]
        );

        // 3️⃣ Process products
        foreach ($models as $product) {

            $currentStock = (int) $product->current_stock;

            $fulfillableQty = min($requestedQty, $currentStock);
            $shortfall = $requestedQty - $fulfillableQty;

            // Deduct available stock
            $product->current_stock = $currentStock - $fulfillableQty;

            // Record shortage
            if ($shortfall > 0) {
                $product->stockout += $shortfall;
            } else {
                $product->stockout = 0;
            }

            $product->save();

            // 4️⃣ Create order item
            \App\Models\OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'qty' => $fulfillableQty,
                'price' => $product->price ?? 0,
            ]);
        }

        return Action::message('Order validated successfully.');
    }

    public function fields()
    {
        return [
            Number::make('Quantity', 'qty')
                ->min(1)
                ->default(1)
                ->rules('required', 'integer', 'min:1'),
        ];
    }
}