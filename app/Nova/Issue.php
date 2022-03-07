<?php

namespace App\Nova;

use App\Helpers\Model;
use App\Models\Issue as ModelsIssue;
use App\Nova\Actions\MarkAsSolved;
use App\Nova\Traits\HideTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\User as UserModel;

class Issue extends Resource
{
    use HideTrait;

    const hideToUserType = Model::forAll;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Issue::class;

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
        'created_at',
        'Subject'
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
            Date::make('created_at')
                ->exceptOnForms()
                ->sortable(),
            BelongsTo::make('User', 'user', User::class),
            Text::make('Subject')
                ->rules(['required']),
            Textarea::make('Details')
                ->alwaysShow()
                ->rules(['required']),
            Text::make('Attachment', fn () => is_null($this->attachment) ? "No Attachment." :"<a target='_blank' href='/storage/$this->actual_file'>View<a/>")
                ->asHtml(),
            Badge::make('Status')
                ->map([
                    ModelsIssue::STATUS_PENDING => 'info',
                    ModelsIssue::STATUS_SOLVED => 'success',
                ])
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
            (new MarkAsSolved)
        ];
    }
}
