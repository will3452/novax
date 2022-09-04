<?php

namespace App\Nova;

use App\Nova\Actions\Approve;
use App\Nova\Actions\PayNow;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Select;
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
    public static $title = 'date';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        // 'id',
        'date',
        'time',
        'description'
    ];



    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->id() != 1) {
            return $query->whereUserId(auth()->id());
        }
        return $query;
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
            BelongsTo::make('Created By', 'user', User::class)->exceptOnForms(),
            Date::make('Requested Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),

            Date::make('Appointment Date', 'date')
                ->sortable(),

            Select::make('Time')
                ->options(fn () => \App\Models\Timeslot::get()->pluck('time', 'time')),

            Textarea::make('Description')
                ->alwaysShow(),
            Badge::make('Status', fn () => $this->approved_at == null ? 'Not yet approved': $this->paid_at != null ? 'Paid' : 'Approved')->map([
                'Not yet approved' => 'warning',
                'Approved' => 'success',
                'Paid' => 'success',
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
        return [
            (new Approve)->canSee( fn () => auth()->id() == 1 && $this->approved_at == null)->showOnTableRow(fn () => auth()->id() == 1),
            (new PayNow)->showOnTableRow(fn () => auth()->id() == $this->user_id),
        ];
    }
}
