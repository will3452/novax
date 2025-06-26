<?php

namespace App\Nova;

use App\Nova\Actions\ConfirmTransaction;
use App\Nova\Actions\GenerateInvoice;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Sale extends BranchResourceFilter
{

    public static $group = '3. transaction';

    public static function indexQuery(NovaRequest $request, $query)
    {
        $parentQuery = parent::indexQuery($request, $query);
        return $parentQuery->whereStatus('CONFIRMED');
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Sale::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        return "S" . Str::padLeft($this->id, 6, '0');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            BelongsTo::make('Branch'),
            Hidden::make('cashier_id')
                ->default(fn () => auth()->id()),
            Date::make('Date')
                ->sortable()
                ->rules(['required']),
            Currency::make('Total Amount')
                ->exceptOnForms(),
            BelongsTo::make('Customer')
                ->showCreateRelationButton(),
            // Select::make('Payment Method')
            //     ->options(\App\Models\PaymentMethod::get()->pluck('name', 'name')),
            HasMany::make('Items', 'items', SaleItem::class),
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
            GenerateInvoice::make()->showOnTableRow(),
        ];
    }
}
