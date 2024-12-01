<?php

namespace App\Nova;

use App\Nova\Actions\Approve;
use App\Nova\Actions\AttachSignature;
use App\Nova\Actions\ChangeStatus;
use App\Nova\Actions\Decline;
use App\Nova\Actions\ReviewAndDownloadForm;
use GeneaLabs\NovaMapMarkerField\MapMarker;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class VehicleRequestForm extends Resource
{
    public static function label () {
        return "Vehicle Request";
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\VehicleRequestForm::class;

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
            Date::make('Date')->sortable(),
            BelongsTo::make('Requestor', 'user', User::class),
            Textarea::make('Purpose')->alwaysShow(),
            Textarea::make('Passengers', 'remarks')
                ->alwaysShow(),
            BelongsTo::make('Driver', 'driver', Driver::class),
            // Text::make('Status'),
            Select::make('Status')
                ->options([
                    'approved' => 'approved',
                    'pending' => 'pending',
                    'rejected' => 'rejected',
                ]),
            Image::make('Signature')->hideFromIndex(),
            MapMarker::make('Origin')
                ->longitude('p_long')
                ->latitude('p_lat'),
            MapMarker::make('Destination')
                ->longitude('d_long')
                ->latitude('d_lat')
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
            // ChangeStatus::make(),
            Approve::make()->showOnTableRow(),
            Decline::make()->showOnTableRow(),
            ReviewAndDownloadForm::make()->showOnTableRow(),
            AttachSignature::make()->showOnTableRow(),
            DownloadExcel::make(),
        ];
    }
}
