<?php

namespace App\Nova;

use App\Nova\Actions\ApproveStore;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Store extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Store::class;

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
        'name',
        'store_name',
        'farmers_cooperative_id'
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
            Text::make('Owner', 'name')
                ->rules(['required']),
            Text::make('Store Name')
                ->rules(['required']),
            Text::make('Email')
                ->rules(['required', 'unique:users,email,{{resourceId}}']),
            Password::make('Password')
                ->rules(['required']),
            Text::make('Address'),
            Text::make("Farmer's cooperative ID")
                ->rules(['required']),
            Text::make('Phone')
                ->rules(['required']),
            Badge::make('Store Status', fn () => is_null($this->approved_as_store_owner_at) ? 'For Approval' : 'Approved')
                ->map([
                    'For Approval' => 'info',
                    'Approved' => 'success',
                ]),
            Badge::make('Phone Status', fn () => is_null($this->phone_verified_at)? 'Not Verified' : 'Verified')->map([
                'Not Verified' => 'danger',
                'Verified' => 'success',
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
            (new ApproveStore)
        ];
    }
}
