<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Hidden;
use App\Nova\Actions\AddStudent;
use App\Nova\Actions\ChangeStatus;
use App\Nova\Actions\SaveCounselling;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\Counselling as ModelsCounselling;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasOne;

class IndividualCounselling extends Resource
{
    public static $group = 'Counselling';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\IndividualCounselling::class;

    public function authorizedToAttachAny(NovaRequest $request, $model)
    {
        return false;
    }



    public function authorizedToDetach(NovaRequest $request, $model, $relationship)
    {
        return ModelsCounselling::find($request->viaResourceId)->status === ModelsCounselling::STATUS_DRAFTED;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) {
            return true;
        }

        return $this->status === ModelsCounselling::STATUS_DRAFTED;
    }

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
            Date::make('Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),

            BelongsTo::make('Branch', 'branch', Branch::class)->required(),

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

            HasOne::make('Student', 'CounsellingStudent', CounsellingStudent::class),


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
            (new AddStudent($this->branch_id))
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
                    return $model->status === ModelsCounselling::STATUS_DRAFTED && ($model->counsellingstudents()->count() == 0 || $model->counsellingstudents()->count() > 1);
                })
                ->onlyOnDetail(),
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
                    return $model->status === ModelsCounselling::STATUS_DRAFTED && $model->counsellingstudents()->count();
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
