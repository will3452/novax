<?php

namespace App\Nova;

use App\Models\Booking as ModelsBooking;
use App\Nova\Actions\Approve;
use App\Nova\Actions\MarkAsFinished;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Booking extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Booking::class;

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
            BelongsTo::make('User', 'user', User::class)
                ->exceptOnForms(),
            Image::make('Proof Of Payment')
                ->rules(['required', 'max:5000']),
            DateTime::make('Date and Time', 'date_time')
                ->rules(['required', 'date', 'after:today']),
            Textarea::make('Notes')->alwaysShow(),
            Badge::make('Status')
                ->map([
                    'On-Queue' => 'info',
                    'Declined' => 'danger',
                    'Approved' => 'success',
                    'Finished' => 'warning',
                ]),
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
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

        $actions = [];

        return [
            Approve::make(),
            MarkAsFinished::make(),
        ];
    }
}
