<?php

namespace App\Nova;

use App\Models\Branch as ModelsBranch;
use App\Nova\Metrics\BranchWarehouses;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Branch extends Resource
{

    public static $group = 'System Setup';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Branch::class;

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
        'address',
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
            (new Tabs('Branch', [
                'Details' => [
                    Text::make('Name')->sortable(),
                    Text::make('Address')->sortable(),
                    Text::make('Phone'),
                ],
                HasMany::make('Warehouses', 'warehouses', Warehouse::class),
                BelongsToMany::make('Products'),
                HasMany::make('Inventories', 'inventories', Inventory::class),
                HasMany::make('Sales', 'sales', Sale::class),
            ]))->withToolbar(),
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
        $branch = ModelsBranch::find($request->resourceId);
        if ($branch) {
            return [
                (new BranchWarehouses($branch))->onlyOnDetail(),
            ];
        }

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
