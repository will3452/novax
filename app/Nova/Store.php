<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Store extends Resource
{
    public static $group = 'Store';

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->isAdmin()) return $query;
        return $query->whereUserId(auth()->id());
    }
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
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
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
            Boolean::make('Private', 'is_private'),
            BelongsTo::make('Owner', 'owner', User::class),
            Text::make('Name')
                ->sortable()
                ->rules(['required']),
            Avatar::make('Logo'),
            Image::make('Banner'),
            Textarea::make('Description'),
            Select::make('Category')
                ->options(\App\Models\StoreCategory::get()->pluck('name', 'name')),
                Flexible::make('Bank Account')
                ->button('Add Account')
                ->addLayout('Account Details', 'wysiwyg', [
                    Select::make('Bank')
                        ->options([
                            "BDO Unibank (BDO)" => "BDO Unibank (BDO)",
                            "Metropolitan Bank & Trust Company (Metrobank)" => "Metropolitan Bank & Trust Company (Metrobank)",
                            "Bank of the Philippine Islands (BPI)" => "Bank of the Philippine Islands (BPI)",
                            "Land Bank of the Philippines (Landbank)" => "Land Bank of the Philippines (Landbank)",
                            "Philippine National Bank (PNB)" => "Philippine National Bank (PNB)",
                            "China Banking Corporation (China Bank)" => "China Banking Corporation (China Bank)",
                            "Security Bank Corporation" => "Security Bank Corporation",
                            "Rizal Commercial Banking Corporation (RCBC)" => "Rizal Commercial Banking Corporation (RCBC)",
                        ]),
                    Text::make('Account No.', 'account_number')
                ]),
            Text::make('Business License Number'),
            Text::make('Tax Identification Number'),
            Heading::make('Contact & Address Information'),
            Text::make('Phone'),
            Text::make('Address'),
            Text::make('City'),
            Text::make('Province'),
            Text::make('Postal Code', 'postal'),
            Country::make('Country'),
            Heading::make('Schedules'),
            Text::make('Opening Hours'),
            Text::make('Closing Hours'),
            Text::make('Days Closed'),
            Heading::make('Social Media'),
            Text::make('Facebook'),
            Text::make('Instagram'),
            Text::make('Twitter (x)', 'twitter'),
            Text::make('LinkedIn', 'linkedIn'),
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
