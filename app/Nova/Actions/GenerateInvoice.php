<?php

namespace App\Nova\Actions;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;

class GenerateInvoice extends Action
{
    use InteractsWithQueue, Queueable;

    public function getItems($items) {
        return $items->map(function ($item) {
            $name = $item->salable->name;
            if ($item->salable_type == "App\Models\Product") {
                $brandName = $item->salable->brand->name;
                $name =  implode("-", [$brandName, $name]);
            }
            return [
                'description' => $name,
                'qty' => $item->qty,
                'unit_price' => $item->price,
                'amount' => $item->price * $item->qty,
            ];
        });
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
        foreach ($models as $model) {
            if ($model->status != 'CONFIRMED') return Action::danger('Transaction is not yet confirmed!');
            $branch = $model->branch;
            $cashier = $model->cashier;
            $customer = $model->customer;
            $items = $this->getItems($model->items);

            Invoice::create([
                'items' => $items,
                'branch_name' => $branch->name,
                'branch_address' => $branch->address,
                'is_cash_sales' => $fields->is_cash_sales,
                'is_charge_sales' => $fields->is_charge_sales,
                'customer_name' => "$customer->first_name $customer->last_name",
                'customer_tin' => $customer->tin ?? '', // should be pull to customer tin
                'customer_address' => $customer->address,
                'total_sales' => $model->total_amount,
                'total_amount_due' => $model->total_amount,
                'sale_id' => $model->id,
                'branch_id' => $branch->id,
                'cashier' => $cashier->name,
                'type' => $fields->type,
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
            Boolean::make('Cash Sales', 'is_cash_sales'),
            Boolean::make('Charge Sales', 'is_charge_sales'),
            Select::make('Type')
                ->options([
                    'Service' => 'Service',
                    'Sales' => 'Sales',
                ])
        ];
    }
}
