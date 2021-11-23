<?php

namespace App\Nova;

use App\Models\Booking as ModelsBooking;
use App\Models\Role;
use App\Nova\Actions\ChangeStatus;
use App\Nova\Actions\SetBookDateTime;
use App\Nova\Filters\ViewStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Booking extends Resource
{
    public static $polling = true;

    public static $group = "Menu";

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (!auth()->user()->hasRole(\App\Models\Role::SUPERADMIN)) {
            $ids = auth()->user()->shops->pluck('id')->toArray();
            return $query->whereIn('shop_id', $ids);
        }
        return $query;
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
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'shop_id',
        'user_id',
        'created_at',
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
            Date::make('Booked At', 'created_at')
                ->exceptOnForms(),

            BelongsTo::make('Customer', 'user', User::class),

            BelongsTo::make('Shop', 'shop', Shop::class),

            DateTime::make('Book DateTime', 'date'),

            Textarea::make('Services')->alwaysShow(),

            Select::make('Status')
                ->options([
                    ModelsBooking::STATUS_PENDING => ModelsBooking::STATUS_PENDING,
                    ModelsBooking::STATUS_CANCELLED => ModelsBooking::STATUS_CANCELLED,
                    ModelsBooking::STATUS_FINISHED => ModelsBooking::STATUS_FINISHED,
                ])->onlyOnForms(),

            Badge::make('Status')
                    ->map([
                        ModelsBooking::STATUS_PENDING => 'info',
                        ModelsBooking::STATUS_CANCELLED => 'danger',
                        ModelsBooking::STATUS_FINISHED => 'success',
                    ])
                    ->exceptOnForms()


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
            ViewStatus::make()
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
            ChangeStatus::make(),
            SetBookDateTime::make(),
        ];
    }
}
