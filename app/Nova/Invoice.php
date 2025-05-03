<?php

namespace App\Nova;

use App\Nova\Actions\PrintInvoice;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Invoice extends BranchResourceFilter
{
    public static $group = '3. transaction';
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true;
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        // return false;
        return true;
    }

    public function authorizedToView(Request $request)
    {
        return false;
    }

    public static function label () {
        return "Invoice";
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Invoice::class;

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
            Text::make('Invoice Number')
                ->exceptOnForms()
                ->sortable(),
            Badge::make('Type', fn () => $this->type ?? 'Sales')
                ->map([
                    'Sales' => 'success',
                    'Service' => 'info',
                ]),
            Stack::make('Branch', 'branch_name', [
                // Avatar::make('Logo', fn () => $this->branch->image),
                Text::make('Branch Name'),
                Text::make('Branch Address')
            ])->sortable(),
            Stack::make('Customer', 'customer_name', [
                Text::make('Customer Name'),
                Text::make('Customer TIN', 'customer_tin'),
                Text::make('Address', 'customer_address'),
            ])->sortable(),
            Currency::make('Total Sales')->sortable(),
            Currency::make('Total Amount Due')->sortable(),
            Text::make('Cashier')->sortable(),
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
            PrintInvoice::make()->showOnTableRow()->withoutConfirmation(),
        ];
    }
}
