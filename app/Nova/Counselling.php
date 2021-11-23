<?php

namespace App\Nova;

use App\Models\Counselling as ModelsCounselling;
use App\Models\Student as ModelsStudent;
use App\Nova\Actions\ChangeStatus;
use App\Nova\Actions\SaveCounselling;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Counselling extends Resource
{
    public static $group = 'Services';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Counselling::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference_number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'reference_number',
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
            Date::make('Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),

            Text::make('Reference Number', 'reference_number')
                ->sortable()
                ->exceptOnForms(),

            Badge::make('Status')
                ->map([
                    ModelsCounselling::STATUS_DRAFTED => 'warning',
                    ModelsCounselling::STATUS_SAVED => 'info',
                    ModelsCounselling::STATUS_SOLVED => 'success',
                    ModelsCounselling::STATUS_RESCHEDULED => 'danger',
                ]),

            Trix::make('Background of the case', 'case')
                ->alwaysShow()
                ->rules('required', 'max:1000'),

            Trix::make('Goal/s', 'goal')
                ->alwaysShow()
                ->rules('required', 'max:1000'),

            Trix::make('Plan/s', 'plan')
                ->alwaysShow()
                ->rules('required', 'max:1000'),

            Trix::make('Recommendation/s', 'recommendation')
                ->alwaysShow()
                ->rules('required', 'max:1000'),

            BelongsToMany::make('Students Involved', 'students', Student::class)
                ->searchable(),

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
            SaveCounselling::make()
                ->onlyOnDetail()
                ->canSee(function (NovaRequest $resource) {
                    if ($resource->has('action')) {
                        return true;
                    }
                    $model = null;
                    if ($resource->resourceId) {
                        $model = ModelsCounselling::find($resource->resourceId);
                    }

                    if ($resource->viaResourceId) {
                        $model = ModelsCounselling::find($resource->viaResourceId);
                    }


                    if ($model == null) {
                        return false;
                    }
                    return $model->status === ModelsCounselling::STATUS_DRAFTED;
                }),
            ChangeStatus::make()
                ->onlyOnDetail()
                ->canSee(function (NovaRequest $resource) {
                    if ($resource->has('action')) {
                        return true;
                    }
                    $model = null;
                    if ($resource->resourceId) {
                        $model = ModelsCounselling::find($resource->resourceId);
                    }

                    if ($resource->viaResourceId) {
                        $model = ModelsCounselling::find($resource->viaResourceId);
                    }


                    if ($model == null) {
                        return false;
                    }
                    return $model->status === ModelsCounselling::STATUS_SAVED;
                }),
        ];
    }
}
