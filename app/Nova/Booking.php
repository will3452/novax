<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use App\Models\Booking as ModelsBooking;
use App\Nova\Actions\ChangeStatus;
use Laravel\Nova\Fields\Select;
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
    public static $title = 'reference_number';

    public function subtitle()
    {
        return $this->room->name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'reference_number',
        'created_at',
        'status',
    ];

    public static function relatableRooms(NovaRequest $request, $query)
    {
        return $query->whereAvailable(true);
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            Text::make('Reference Number')
                ->exceptOnForms(),

            Date::make('Booked At', 'created_at')
                ->exceptOnForms(),

            Text::make('Customer Name')
                ->rules(['required']),

            Select::make('Channel')
                ->rules(['required'])
                ->options([
                    ModelsBooking::BOOKING_CHANNEL_WALK_IN => ModelsBooking::BOOKING_CHANNEL_WALK_IN,
                    ModelsBooking::BOOKING_CHANNEL_WEBSITE => ModelsBooking::BOOKING_CHANNEL_WEBSITE,
                ]),

            Badge::make('Status')
                ->map([
                    ModelsBooking::BOOKING_STATUS_DISAPPROVED => 'danger',
                    ModelsBooking::BOOKING_STATUS_PENDING => 'warning',
                    ModelsBooking::BOOKING_STATUS_APPROVED => 'success',
                    ModelsBooking::BOOKING_STATUS_IN => 'info',
                    ModelsBooking::BOOKING_STATUS_OUT => 'warning',
                ]),

            Text::make('Client Mobile No.', 'mobile_number'),

            BelongsTo::make('Room', 'room', Room::class)
                ->rules(['required']),

            Datetime::make('Arrival')
                ->default(function () {
                    return now()->format('Y-m-d H:i:s.u');
                })
                ->rules(['required', 'after_or_equal:now']),

            Datetime::make('Departure')
                ->rules(['required', 'after_or_equal:arrival']),

            Currency::make('Total cost')
                ->required(),

            Currency::make('Discount')
                ->exceptOnForms(),

            BelongsTo::make('Receptionist', 'approver', User::class)
                ->exceptOnForms(),

            BelongsTo::make('Customer Account', 'user', User::class)
                ->exceptOnForms(),
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
            ChangeStatus::make(),
        ];
    }
}
