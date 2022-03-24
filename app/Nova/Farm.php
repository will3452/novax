<?php

namespace App\Nova;

use App\Models\Barangay;
use App\Models\Farm as ModelsFarm;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Farm extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Farm::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return "$this->crops-$this->barangay-$this->land_owner";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'crops',
        'barangay',
        'land_owner'
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
                ->exceptOnForms()
                ->sortable(),

            Text::make('Crops')
                ->rules(['required']),

            Select::make('Barangay')
                ->searchable()
                ->rules(['required'])
                ->options(Barangay::get()->pluck('name', 'name')),

            Text::make('Address')
                ->rules(['required']),

            Number::make('Total Farm Area (ha)', 'total_form_area')
                ->rules('required')
                ->step('0.1'),

            Text::make('Land Owner')
                ->default(fn()=>optional($this->farmer)->name ?? '')
                ->rules(['required']),

            Text::make('Tenure Type')
                ->rules(['required']),

            Number::make('Size')
                ->step('0.1')
                ->rules(['required']),

            Boolean::make('Is Organically Grown'),

            Select::make('Source Of Water')
                ->rules(['required'])
                ->options([
                    ModelsFarm::SOW_DEEP_WELL => ModelsFarm::SOW_DEEP_WELL,
                    ModelsFarm::SOW_TUBE_WELL => ModelsFarm::SOW_TUBE_WELL,
                ]),
            BelongsTo::make('Farmer', 'farmer', Farmer::class),
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
