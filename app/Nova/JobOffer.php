<?php

namespace App\Nova;

use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use App\Models\JobOffer as ModelsJobOffer;
use App\Nova\Actions\JobOffer\ChangeStatus;
use Facade\Ignition\Tabs\Tab;
use Laravel\Nova\Http\Requests\NovaRequest;

class JobOffer extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (!$request->user()->hasRole(\App\Models\Role::SUPERADMIN)) {
            return $query->where('employer_id', $request->user()->id);
        }
        return $query;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToAdd(NovaRequest $request, $model)
    {
        if ($request->viaRelationship === 'tags') {
            return true;
        }

        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\JobOffer::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public function title()
    {
        return "$this->position - " . $this->employer->name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'position',
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
            new Tabs('Offer', [
                'Offer Details' => [
                    Date::make('Posted Date', 'created_at')
                    ->sortable()
                    ->exceptOnForms(),

                    BelongsTo::make('Employer', 'employer', User::class)
                        ->exceptOnForms(),

                    Text::make('Position')
                        ->rules(['required']),

                    Textarea::make('Description')
                        ->rules(['required'])
                        ->alwaysShow(),

                    Number::make('Salary per month', 'salary')
                        ->sortable(),

                    Number::make('Total Slot', 'slot')
                        ->required(),

                    Number::make('Available Slot', function () {
                        return $this->available_number_of_slots;
                    }),

                    Number::make('No. Of Application', function () {
                        return $this->applications()->count();
                    })->exceptOnForms(),

                    Date::make('Ended Date', 'ended_at'),

                    Boolean::make('Urgent'),

                    Badge::make('Status')
                        ->map([
                            ModelsJobOffer::STATUS_OPEN => 'success',
                            ModelsJobOffer::STATUS_CLOSED => 'danger',
                        ]),
                    ],

                HasMany::make('Tags', 'tags', Tag::class),
            ]),

            HasMany::make('Applications', 'applications', JobApplication::class),


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
