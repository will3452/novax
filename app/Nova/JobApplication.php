<?php

namespace App\Nova;

use App\Models\JobApplication as ModelsJobApplication;
use App\Nova\Actions\JobApplication\ChangeStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class JobApplication extends Resource
{
    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) {
            return true;
        }
        return false;
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\JobApplication::class;

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
        'created_at'
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
            Date::make('Date Submitted', 'created_at')
                ->sortable()
                ->exceptOnForms(),

            BelongsTo::make('Job Offer', 'jobOffer', JobOffer::class),

            BelongsTo::make('Applicant', 'applicant', User::class),

            Badge::make('Status')
                ->map([
                    ModelsJobApplication::STATUS_ACCEPTED => 'success',
                    ModelsJobApplication::STATUS_DECLINED => 'danger',
                    ModelsJobApplication::STATUS_INTERVIEW => 'info',
                    ModelsJobApplication::STATUS_PENDING => 'warning',
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
            ChangeStatus::make(),
        ];
    }
}
