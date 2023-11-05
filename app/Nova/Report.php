<?php

namespace App\Nova;

use App\Models\Report as ModelsReport;
use App\Nova\Metrics\Reports;
use App\Nova\Metrics\ReportsTrend;
use GeneaLabs\NovaMapMarkerField\MapMarker;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;

class Report extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Report::class;

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
        'status',
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
            Date::make('Date Reported', 'created_at')->sortable()->exceptOnForms(),
            BelongsTo::make('Category', 'category', ReportCategory::class),
            Textarea::make('Description'),
            Badge::make('Status')->map(
                [
                    ModelsReport::STATUS_DONE => 'success',
                    ModelsReport::STATUS_NEW => 'warning',
                ]
            ),
            Select::make('Status')
                ->options([
                    'Done' => 'Done',
                    'New' => 'New'
                ]), 
            Image::make('Image'),
            BelongsTo::make('User', 'user'),
            MapMarker::make('Location')
                ->longitude('lng')
                ->latitude('lat'),
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
        return [
            Reports::make(),
            ReportsTrend::make(),
        ];
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
