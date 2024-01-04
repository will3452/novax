<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use App\Nova\Filters\EndDate;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use App\Nova\Filters\DateRange;
use App\Nova\Filters\StartDate;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\PrintAssetRegisterReport;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Asset extends Resource
{
    public static $group = "Record Management";

    public static function icon()
    {
        return '
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>';
    }

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
        'purchase_date',
        'description',
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
            Text::make('Location'),
            Text::make('Owner')
                ->rules(['required']),
            Text::make('Users')
                ->rules(['required']),
            Text::make('Serial Number / Bar Code', 'serial_number')
                ->rules(['required']),
            Text::make('Insurance Coverage')
                ->rules(['required']),
            Number::make('Current Value of Asset', 'current_value')
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
        return [
            StartDate::make(),
            EndDate::make(),
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
            new PrintAssetRegisterReport,
            new DownloadExcel(),
        ];
    }
}
