<?php

namespace App\Nova;

use App\Nova\Actions\PrintAssetRegisterReport;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Asset extends Resource
{
    public static $group = "Record Management";

    public static function label()
    {
        return 'Asset Register';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Asset::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return "$this->description - $this->purchase_date";
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
            Text::make('Description')
                ->rules(['required'])
                ->sortable(),
            Date::make('Purchase Date')
                ->rules(['required'])
                ->sortable(),
            Number::make('Purchase Cost')
                ->rules(['required']),
            Text::make('Location')
                ->rules(['required']),
            Text::make('Owner')
                ->rules(['required']),
            Text::make('Users')
                ->rules(['required']),
            Text::make('Serial Number / Bar Code', 'serial_number')
                ->rules(['required']),
            Text::make('Insurance Coverage')
                ->rules(['required']),
            Text::make('Current Value of Asset', 'current_value')
                ->rules(['required']),
            Text::make('Depreciation Method used')
                ->rules(['required']),
            Text::make("Manufacturer's Warranty", 'manufacturers_warranty')
                ->rules(['required']),
            Text::make('Maintenance Information')
                ->rules(['required']),
            Text::make('Life Expectancy')
                ->rules(['required']),
            Text::make('Estimated Resale Value')
                ->rules(['required']),
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
            new PrintAssetRegisterReport,
        ];
    }
}
