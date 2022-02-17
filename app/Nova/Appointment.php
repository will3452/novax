<?php

namespace App\Nova;

use App\Models\Appointment as ModelsAppointment;
use App\Models\Role;
use App\Models\User;
use App\Nova\Actions\Appointment\ChangeStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Appointment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Appointment::class;

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
        'date',
        'time',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $fields = [
            Badge::make('Status')
                ->map([
                    ModelsAppointment::STATUS_APPROVED => 'info',
                    ModelsAppointment::STATUS_COMPLETED => 'success',
                    ModelsAppointment::STATUS_PENDING => 'danger',
                ]),
            Date::make('Date')
                ->sortable()
                ->rules(['required', 'after:now']),
            Text::make('Time')
                ->rules(['required']),
            Textarea::make('Notes')
                ->alwaysShow()
                ->rules(['max:500']),
        ];


        if (auth()->user()->type !== User::TYPE_PATIENT || auth()->user()->hasRole(Role::SUPERADMIN) || is_null(auth()->user()->type)) {
            array_push($fields, BelongsTo::make('User', 'user', \App\Nova\User::class));
        }

        return $fields;
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
            (new ChangeStatus),
        ];
    }
}
