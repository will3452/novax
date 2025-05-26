<?php

namespace App\Nova\Actions;

use App\Models\Branch;
use App\Models\CartItem;
use App\Models\Sale;
use App\Models\SaleItem;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Currency;

class ProceedToOrder extends Action
{
    use InteractsWithQueue, Queueable, HasDependencies;

    public $confirmButtonText = 'Create Order';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $items = CartItem::whereCashierId(auth()->id())->get();

        $sale = Sale::create([
            'total_amount' => $fields->total_amount,
            'customer_id' => $fields->customer_id,
            'payment_method' => $fields->payment_method,
            'branch_id' => $items[0]->branch_id,
            'cashier_id' => auth()->id(),
            'date' => now(),
            'type' => $items[0]->item_type == 'App\Models\Product' ? 'SALES': 'SERVICE',
        ]);

        foreach ($items as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'salable_id' => $item->item_id,
                'salable_type' => $item->item_type,
                'qty' => $item->qty,
                'price' => $item->price,
                'remarks' => $item->remarks,
                'discount' => $item->discount,
            ]);
            $item->delete();
        }

        return Action::redirect(route('print.order-slip', $sale));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Currency::make('Total Amount')
                ->default(function () {
                    $items = \App\Models\CartItem::whereCashierId(auth()->id())->get();
                    $total = 0;
                    foreach ($items as $item) {
                        $total += ($item->price * $item->qty);
                    }

                    return $total;
                }),
            Select::make('Customer', 'customer_id')
                ->required()
                ->options(fn () => \App\Models\Customer::get()->pluck('name', 'id'))
                ->searchable(),
            Select::make('Payment Method')
                ->rules(['required'])
                ->options(\App\Models\PaymentMethod::get()->pluck('name', 'name')),
        ];
    }
}
