<?php

namespace App\Nova;

use App\Nova\Actions\MarkAsApproved;
use App\Nova\Filters\PickUpDateFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class PreOrder extends Resource
{
    public static $group = 'Sales';
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    public static function availableForNavigation(Request $request)
    {
        return in_array(auth()->user()->type, ['administrator', 'sales', 'inventory manager']);
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true;

        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PreOrder::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'reference',
        'created_at',
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
            Date::make('Date', 'created_at')
                ->sortable(),
            Date::make('Pick Up Date', 'pickup_date')
                ->sortable(),
            Text::make('Reference'),
            KeyValue::make('Customer')->keyLabel('Details'),
            Select::make('Status')
                ->options([
                    'For Confirmation' => 'For Confirmation',
                    'Confirmed' => 'Confirmed',
                    // 'Paid' => 'Paid',
                ]),
            Currency::make('Payable'),
            HasMany::make('Items', 'items', PreOrderItem::class),
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
        return [
            PickUpDateFilter::make(),
        ];
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
            MarkAsApproved::make(),
        ];
    }
}
