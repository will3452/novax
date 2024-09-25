<?php

namespace App\Nova;

use Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Loan extends Resource
{
    public static $group = '1_Services'; 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Loan::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
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
            
            Text::make('Reference')
                ->exceptOnForms(), 
            Badge::make('Status')
                ->map([
                    'PENDING' => 'warning',
                    'APPROVED' => 'success',
                    'REJECTED' => 'rejected', 
                ]), 
            Hidden::make('Reference', 'reference')
                ->default(fn () => "L" . Str::random(8)), 
            Text::make('Reference')->sortable(), 
            Select::make('Type')
                ->options([
                    'INDIVIDUAL' => 'INDIVIDUAL',
                    'GROUP' => 'GROUP', 
                ]),
            Number::make('Terms')
                ->help('in week'),
            Currency::make('Amount'),
            Select::make('Interest')
                ->options(fn () => \App\Models\Interest::get()->pluck('name', 'rate')), 
            Select::make('Payment Schedule')
                ->options([
                    'DAILY' => 'DAILY',
                    'WEEKLY' => 'WEEKLY',
                    'MONTHLY' => 'MONTHLY', 
                ]),
            Date::make('Start Date'),
            Date::make('End Date'),
            Textarea::make('Collateral'),
            Image::make('Collateral Image'), 
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
