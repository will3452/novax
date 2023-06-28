<?php

namespace App\Nova;

use App\Nova\Actions\ApprovePayment;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Payment extends Resource
{
    public static $group = 'Client';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Payment::class;

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
        'approved_at',
        'amount',
        'pay_for_month',
    ];

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->client != null;
    }

    public function authorizedToUpdate(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN || auth()->user()->type == \App\Models\User::TYPE_EMPLOYEE;
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Status', function () {
                if ($this->approved_at != null) {
                    return 'Approved';
                }

                return 'Pending';
            })
                ->exceptOnForms(),
            Date::make('Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),
            Hidden::make('client_id')->default(function () {
                return auth()->user()->client;
            }),
            Select::make('Method')->options([
                'Over-the-counter' => 'Over-the-counter',
                'GCASH' => 'GCASH',
                'MAYA' => 'MAYA',
                'BANK' => 'BANK',
            ])->rules(['required']),
            Currency::make('Amount')
                ->rules(['required']),
            Image::make('Proof of Payment', 'proof')->rules(['required']),
            Date::make('Pay for the Month', 'pay_for_month')
                ->rules(['required'])
                ->pickerDisplayFormat('M')
                ->format('MMM'),
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
            ApprovePayment::make()->canSee(function () {
                return auth()->user()->type != \App\Models\User::TYPE_CLIENT;
            }),
        ];
    }
}
