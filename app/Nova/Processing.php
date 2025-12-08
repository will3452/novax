<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\UpdateToReadyForPickup;

class Processing extends Resource
{
    public static function label()
    {
        return "   Processing";
    }
    public static function group()
    {
        return "Doc Requests";
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has("action")) {
            return true;
        }
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where("status", "processing");
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\DocumentRequest::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = "id";

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ["id", "created_at", "status"];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make("Reference Number", "reference_number")->sortable(),
            Date::make("Date Requested", "created_at")
                ->sortable()
                ->exceptOnForms(),
            BelongsTo::make("Requestor", "user", User::class)->sortable(),
            BelongsTo::make(
                "Barangay",
                "barangay",
                Barangay::class,
            )->sortable(),
            BelongsTo::make(
                "Document",
                "document",
                Document::class,
            )->sortable(),
            Currency::make("Fee", "fee")->sortable(),
            Text::make("Processing Period", "processing_period"),
            Textarea::make("Purpose", "purpose")->alwaysShow(),
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
        return [UpdateToReadyForPickup::make()];
    }
}
