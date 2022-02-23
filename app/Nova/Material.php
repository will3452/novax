<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use DigitalCreative\Filepond\Filepond;
use App\Models\Material as ModelsMaterial;
use Laravel\Nova\Http\Requests\NovaRequest;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;

class Material extends Resource
{
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Material::class;

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
            BelongsTo::make('module', 'module', Module::class),
            Text::make('Name')
                ->rules(['required']),
            Select::make('Type')
                ->options([
                    ModelsMaterial::TYPE_HYPERLINK => ModelsMaterial::TYPE_HYPERLINK,
                    ModelsMaterial::TYPE_PDF => ModelsMaterial::TYPE_PDF,
                ])->rules(['required']),
            NovaDependencyContainer::make([
                Filepond::make('Content')
                    ->mimesTypes(['application/pdf'])
                    ->rules(['required', 'max:10000']),
            ])->dependsOn('type', ModelsMaterial::TYPE_PDF),
            NovaDependencyContainer::make([
                Text::make('Content')
                    ->rules(['required'])
            ])->dependsOn('type', ModelsMaterial::TYPE_HYPERLINK),
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
