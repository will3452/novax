<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;

class SupplierBill extends Resource
{
    public static $group = '3. transaction';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SupplierBill::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public function title () {
        return $this->supplier->name . " - " . money($this->amount_due) . " (" .$this->status . ")";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'invoice_no',
        'po_number',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Purchase Order', 'purchaseOrder', PurchaseOrder::class)
                ->exceptOnForms(),
            Hidden::make('supplier_id')
                ->default(fn () => 1),
            Select::make('Purchase Order', 'po_id')
            ->options(function () {
                $options = [];
                $pos = \App\Models\PurchaseOrder::whereStatus('APPROVED')->get();
                foreach ($pos as $po) {
                    $total = money($po->total_cost);
                    $supplier = $po->supplier->name;
                    $pox = "P" . Str::padLeft($po->id, 6, '0') . " - Total Cost: $total - $supplier";
                    $options[$po->id] = $pox;
                }
                return $options;
            })
            ->onlyOnForms()
            ->searchable(),
            BelongsTo::make('Supplier', 'supplier', Supplier::class)->exceptOnForms(),
            Text::make('Invoice No'),
            // Text::make('PO No'),
            Currency::make('Amount Due')->hideWhenCreating(),
            Date::make('Due Date'),
            Badge::make('Status')
                ->map([
                    'PENDING' => 'warning',
                    'DUE' => 'danger',
                    'PAID' => 'success',
                ])
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
