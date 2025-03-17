<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\ApprovePurchaseOrder;
use Laravel\Nova\Http\Requests\NovaRequest;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Current;

class PurchaseOrder extends BranchResourceFilter
{

    public static $group = '3. transaction';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PurchaseOrder::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        return "P" . Str::padLeft($this->id, 6, '0') . " ($this->status)";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'date',
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
            Badge::make('Status')
                ->map([
                    'PENDING' => 'info',
                    // 'REJECTED' => 'warning',
                    'APPROVED' => 'success',
                ]),
            Date::make('Date', 'date')
                ->sortable(),
            BelongsTo::make('Branch', 'branch', Branch::class)
                ->showCreateRelationButton(),
            BelongsTo::make('Supplier', 'supplier', Supplier::class)
                ->showCreateRelationButton(),
            Currency::make('Total Cost')->exceptOnForms(),
            HasMany::make('Items', 'items', PurchaseOrderItem::class),
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
        return [
            ApprovePurchaseOrder::make()
                ->showOnTableRow(),
        ];
    }
}
