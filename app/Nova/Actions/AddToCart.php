<?php

namespace App\Nova\Actions;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Textarea;
use Illuminate\Support\Collection;
use Comodolab\Nova\Fields\Help\Help;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddToCart extends Action
{
    use InteractsWithQueue, Queueable;

    public $type;
    public $price;
    public $maxQty;
    public function __construct($type, $price, $maxQty)
    {
        $this->type = $type;
        $this->price = $price;
        $this->maxQty = $maxQty;
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
        $existingCartItem = CartItem::whereCashierId(auth()->id())->first();
        if ($existingCartItem && $existingCartItem->branch_id != $models[0]->branch_id) {
            CartItem::whereCashierId(auth()->id())->delete();
        }

        foreach ($models as $model) {
            $itemId = $this->type == Product::class ? $model->product_id : $model->service_id;
            CartItem::create([
                'branch_id' => $model->branch_id,
                'item_id' => $itemId,
                'item_type' => $this->type,
                'price' => $fields->price,
                'qty' => $fields->qty,
                'discount' => $fields->discount,
                'description' => $fields->description,
                'cashier_id' => auth()->id(),
            ]);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Help::warning('Warning', 'All your previous cart items from the other branch will be reset.'),
            Number::make('Quantity', 'qty')
                ->max($this->type == "App\Models\Product" ? $this->maxQty: null)
                ->help($this->type == "App\Models\Product" ? "Available: $this->maxQty": ""),
            Currency::make('Price/Rate', 'price')
                ->default(fn () => $this->price),
            Textarea::make('Discount'),
            Textarea::make('Description'),
        ];
    }
}
