<?php

namespace App\Nova;

use App\Models\Barangay;
use App\Models\Farmer as ModelsFarmer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Farmer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Farmer::class;

    /**
 * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'barangay',
        'address',
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
            Text::make('Name')
                ->help('Last Name, First Name, Mi.')
                ->rules(['required', 'unique:farmers,name,{{resourceId}}']),
            Select::make('Barangay')
                ->searchable()
                ->rules(['required'])
                ->options(Barangay::get()->pluck('name', 'name')),

            Text::make('Address')
                ->rules(['required']),

            Date::make('Birth Date')
                ->rules(['required']),

            Select::make('Gender')
                ->rules(['required'])
                ->options([
                    ModelsFarmer::GENDER_FEMALE => ModelsFarmer::GENDER_FEMALE,
                    ModelsFarmer::GENDER_MALE => ModelsFarmer::GENDER_MALE,
                ]),
            Textarea::make('Beneficiary')
                ->alwaysShow(),
            Text::make('Occupation'),
            Boolean::make('4p\'s Family', 'is_4ps_family'),
            Text::make('Name Of Spouse'),
            Select::make('Civil Status')
                ->options([
                    ModelsFarmer::STATUS_SINGLE => ModelsFarmer::STATUS_SINGLE,
                    ModelsFarmer::STATUS_MARRIED =>
                    ModelsFarmer::STATUS_MARRIED,
                    ModelsFarmer::STATUS_DIVORCED => ModelsFarmer::STATUS_DIVORCED,
                    ModelsFarmer::STATUS_SEPARATED => ModelsFarmer::STATUS_SEPARATED,
                    ModelsFarmer::STATUS_WIDOWED => ModelsFarmer::STATUS_WIDOWED,
                ])->rules(['required']),
                Text::make('Other Source Of Income'),
                Text::make('Phone')
                    ->help('11 digit. format 09 - - - - - - - - -')
                    ->rules(['required', 'unique:farmers,phone,{{resourceId}}']),
                Text::make('Email'),
                HasMany::make('Farms', 'farms', Farm::class),
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
