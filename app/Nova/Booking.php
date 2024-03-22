<?php

namespace App\Nova;

use App\Models\Booking as ModelsBooking;
use App\Nova\Actions\BookNow;
use App\Nova\Actions\UpdateBooking;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Booking extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Booking::class;

    public static function authorizedToCreate(Request $request)
    {
        return false; 
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true; 
        return false; 
    }

    public function authorizedToDelete(Request $request)
    {
        return false; 
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_PASSENGER) {
            return $query->wherePassengerId(auth()->id()); 
        }

        if (auth()->user()->type == \App\Models\User::TYPE_DRIVER) {
            return $query->whereDriverId(auth()->id()); 
        }
        return $query; 
    }
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
            Text::make('Reference', 'reference')->sortable(), 
            BelongsTo::make('Driver', 'driver', Driver::class),
            BelongsTo::make('Passenger', 'passenger', Passenger::class),
            Text::make('Pick up Location', 'origin'), 
            Text::make('Destination'),
            Number::make('Number Of passenger'),
            Text::make('Payable'),
            Badge::make('Status')->types([
                ModelsBooking::STATUS_CONFIRMED => 'success', 
                ModelsBooking::STATUS_DONE => 'warning', 
                ModelsBooking::STATUS_PENDING => 'info', 
                'Rejected' => 'danger', 
            ]), 
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
        if (auth()->user()->type == \App\Models\User::TYPE_PASSENGER) {
            array_push($actions, BookNow::make()
            ->withoutConfirmation()
            ->standalone()); 
        }

        if (auth()->user()->type == \App\Models\User::TYPE_DRIVER) {
            array_push($actions, UpdateBooking::make()); 
        }
        return $actions;
    }
}
