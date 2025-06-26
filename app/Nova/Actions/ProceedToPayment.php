<?php

namespace App\Nova\Actions;

use App\Models\Sale;
use App\Models\Inventory;
use App\Models\SalesPayment;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Currency;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProceedToPayment extends Action
{
    use InteractsWithQueue, Queueable;
    public $salesId;
    public function __construct(int $salesId)
    {
        $this->salesId = $salesId;
    }

    public function moveInventory($model) {
             $model->update(['status' => 'CONFIRMED']);
            $items = $model->items;
            foreach ($items as $item) {
                if ($item->salable_type != "App\Models\Product") continue;
                $i = Inventory::whereProductId($item->salable_id)
                    ->whereBranchId($model->branch_id)
                    ->first();
                if ($i) {
                    $i->update(['qty' => $i->qty - $item->qty]);
                } else {
                    Inventory::create([
                        'branch_id' => $model->branch_id,
                        'product_id' => $item->salable_id,
                        'qty' => - $item->qty,
                    ]);
                }
            }
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
        if (count($models) > 1) return Action::danger("Method is not allowed!");
        $sales = $models[0];
        $total_payment = SalesPayment::whereSalesId($sales->id)->sum('amount');
        $remaining = $sales->total_amount - $total_payment;
        if ($remaining <= 0) return Action::danger("Order is already paid!");
        $change = ($fields->cash - $remaining);
        SalesPayment::create([
            'sales_id' => $sales->id,
            'branch_id' => $sales->branch_id,
            'cashier_id' => $sales->cashier_id,
            'type' => 'NA',
            'cash' => $fields->cash,
            'method' => $fields->method,
            'amount' => $fields->cash > $remaining ? $fields->cash - $change: $fields->cash,
            'change' => $fields->cash > $remaining ? $change: 0,
        ]);

        $sales = Sale::find($sales->id);
        if ($sales->balances <= 0) {
            $this->moveInventory($sales);
        }

        return Action::message('Payment has been added!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        $sales = Sale::find($this->salesId);
        $total_payment = SalesPayment::whereSalesId($sales?->id)->sum('amount');
        $remaining = $sales?->total_amount - $total_payment;
        return [
            Select::make('Payment Method', 'method')
                ->rules(['required'])
                ->options(\App\Models\PaymentMethod::get()->pluck('name', 'name')),
            Currency::make('Cash')
                ->help("Remaining Amount: PHP" . number_format($remaining, 2)),
        ];
    }
}
