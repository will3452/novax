<?php

namespace App\Nova;

use App\Models\Supervision;
use App\Nova\Actions\SubmitApplication;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class JobPost extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_HTE) {
            return $query->whereUserId(auth()->id()); 
        }
        return $query;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\JobPost::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN || auth()->user()->type == \App\Models\User::TYPE_HTE;  
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true; 
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN || auth()->user()->id == $this->user_id;  
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == \App\Models\User::TYPE_ADMIN || auth()->user()->id == $this->user_id; 
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
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            BelongsTo::make('HTE/Company', 'author', User::class)->exceptOnForms(), 
            Select::make('Status')
                ->options([
                    'ON-GOING' => 'ON-GOING',
                    'CLOSED' => 'CLOSED', 
                ]),
            Text::make('Title')->rules(['required']),
            Textarea::make('Body')
                ->alwaysShow()
                ->rules(['required']),
            Number::make('Slot')
                ->required(['max:1']), 
            HasMany::make('Applications', 'applications', Application::class), 
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
        $actions = [];
        if (auth()->user()->type == \App\Models\User::TYPE_TRAINEE) {
            $masters = Supervision::whereMemberId(auth()->id())->count();
            if ($masters == 1) {
                array_push($actions, SubmitApplication::make());
            } 
        }
        return $actions;
    }
}
