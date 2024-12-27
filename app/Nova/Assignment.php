<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Assignment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Assignment::class;

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
            Date::make('Date', 'created_at')->exceptOnForms()->sortable(),
            BelongsTo::make('Task', 'task', Task::class),
            BelongsTo::make('User', 'user', User::class),
            Select::make('Status')
                ->options([
                    'PENDING' => 'PENDING',
                    'ON-GOING' => 'ON-GOING',
                    'DONE' => 'DONE',
                    'DROPPED' => 'DROPPED',
                ]),
        Image::make('Proof of Done')->exceptOnForms(),
        Image::make('Proof of Initiation')->exceptOnForms(),
        Text::make('Analyzed Image', function () {
            $tr = \App\Models\TaskResult::whereUserId($this->user_id)->whereTaskId($this->task_id)->latest()->first();
            if (! $tr) return "—";
            return "<a href='/result/$tr->id' target='_blank'>View Image</a>";
        })->asHtml(),
        Hidden::make('eval_status')
                ->default(fn () => 'PENDING'),
        // Select::make('Evaluation', 'eval_status')
        //         ->options([
        //             'PENDING' => 'PENDING',
        //             'CONFIRMED' => 'CONFIRMED',
        //             'REJECTED' => 'REJECTED',
        //         ]),
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
        return [];
    }
}
