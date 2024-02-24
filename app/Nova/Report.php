<?php

namespace App\Nova;

use Illuminate\Http\Request;
use App\Nova\Metrics\Reports;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Actions\AssignReport;
use App\Nova\Metrics\ReportsTrend;
use Laravel\Nova\Fields\BelongsTo;
use App\Models\Report as ModelsReport;
use GeneaLabs\NovaMapMarkerField\MapMarker;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\User as ModelUser; 
class Report extends Resource
{
    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == ModelUser::TYPE_DISPATCHER) {
            $reports = auth()->user()->tasks->pluck('id')->all(); 
            return $query->whereIn('id', $reports); 
        }
        return $query;
    }
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
            // Image::make('Image'),
            Text::make('Images', function () {
                $images = explode("***", $this->image); 
                $html = ""; 
                foreach($images as $img)  {
                    if (strlen($img) == 0) continue; 
                    $html .= "<a target='_blank' href='/storage/$img'><img style='width:50px; height:50px; margin:2px; object-fit:cover;' src='/storage/$img'/></a>";
                }

                return $html; 
            })->asHtml(), 
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
        return [
            AssignReport::make(), 
        ];
    }
}
