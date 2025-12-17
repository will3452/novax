<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class BarangayFacility extends Resource
{
    public static function group()
    {
        return "Manage";
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->is_root) {
            return true;
        }

        $barangays = auth()->user()->barangays()->get()->pluck("id")->toArray();
        // dd($barangays);
        return $query->whereIn("barangay_id", $barangays);
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\BarangayFacility::class;

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
    public static $search = ["id", "name", "description"];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make("Barangay", "barangay", Barangay::class),
            Text::make("Name"),
            Textarea::make("Description")->alwaysShow(),
            Select::make("Category")->options([
                "Business" => "Business",
                "Events" => "Events",
                "Sports" => "Sports",
                "Outdoor" => "Outdoor",
            ]),
            Number::make("Capacity"),
            Image::make("Image", "cover_image"),
            Hidden::make("Status", "status")->default(fn() => "Active"),
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
