<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Http\Requests\NovaRequest;

class LoanMatrix extends Resource
{
    public static function authorizedToCreate(Request $request) {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN;
    }

    public function authorizedToDelete(Request $request) {
       return auth()->user()->type == \App\Models\User::TYPE_ADMIN;
    }

    public function authorizedToView(Request $request) {
        return false;
     }

     public function authorizedToUpdate(Request $request) {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN;
     }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\LoanMatrix::class;

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
        'max',
        'min',
        'value',
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
            Currency::make('From Salary', 'min')->rules(['required']),
            Currency::make('To Salary', 'max')->rules(['required']),
            Currency::make('Loanable Amount', 'value')->rules(['required']),
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
