<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Booking extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        $rooms = \App\Models\Room::whereOwnerId(auth()->id())->get()->pluck('id');
        return $query->whereIn('room_id', $rooms);
    }
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

    public function title () {
        $date = $this->date->format('m-d-y h:i a');
        return "Booking [$this->name] - [$date]";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'date',
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
            Date::make('Date')
                ->rules(['required']),
            Text::make('Email')
                ->rules(['required', 'email']),
            Text::make('Name')
                ->rules(['required']),
            Text::make('Mobile')
                ->rules(['required']),
            Select::make('Status')
                ->rules(['required'])
                ->options([
                    \App\Models\Booking::STATUS_DONE => \App\Models\Booking::STATUS_DONE,
                    \App\Models\Booking::STATUS_PENDING => \App\Models\Booking::STATUS_PENDING,
                ]),
            BelongsTo::make('Room', 'room', Room::class),
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
