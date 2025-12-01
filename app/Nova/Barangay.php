<?php

namespace App\Nova;

use App\Models\City;
use App\Models\Province;
use App\Models\Region;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Laravel\Nova\Card;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Image;
use Yna\NovaSwatches\Swatches;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Barangay extends Resource
{
    use HasDependencies;
    public static function group()
    {
        return "Reference";
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Barangay::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = "name";

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ["id", "name", "address_line"];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $address = [];

        foreach (Region::get() as $region) {
            foreach (
                Province::whereRegionCode($region->code)->get()
                as $province
            ) {
                foreach (
                    City::whereProvinceCode($province->code)->get()
                    as $city
                ) {
                    $address[] = "$city->name, $province->name, $region->code";
                }
            }
        }
        $descriptions = [
            Text::make("Name")->sortable(),
            Select::make("City, Province, Region", "address_line")
                ->options(fn() => array_combine($address, $address))
                ->searchable()
                ->onlyOnForms(),
            Text::make("Region", "region")->sortable()->exceptOnForms(),
            Text::make("Province", "province")->sortable()->exceptOnForms(),
            Text::make("City", "city")->sortable()->exceptOnForms(),
        ];
        return [
            Panel::make("Description", $descriptions),
            Panel::make("Preference", [
                Image::make("Logo")->hideFromIndex(),
                Swatches::make("Primary Color")->hideFromIndex(),
                Swatches::make("Secondary Color")->hideFromIndex(),
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
        return [];
    }
}
