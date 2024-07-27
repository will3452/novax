<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BillingTransaction extends Resource
{
    public static $group = 'Billing'; 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\BillingTransaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title () {
        $reference = $this->reference; 
        $payeeName = \App\Models\User::find($this->user_id)->name;
        $balance = $this->total_amount - \App\Models\BillingPayment::whereBillingTransactionId($this->id)->sum('amount');
        return "$reference - $payeeName [PHP $balance]";  
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'reference', 
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
            Hidden::make('reference')->default(fn () => \Str::random()), 
            Text::make('Reference', function () {
                return $this->reference; 
            }), 
            BelongsTo::make('Payee', 'user', User::class), 
            KeyValue::make('Particulars')
                ->keyLabel('Billing Item')
                ->valueLabel('Amount')
                ->rules('json'), 
            Currency::make('Total Amount')
                ->rules(['required']),
            Currency::make('Balance', function () {
                return $this->total_amount - \App\Models\BillingPayment::whereBillingTransactionId($this->id)->sum('amount');
            }), 
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
