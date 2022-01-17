<?php
namespace App\Nova;
use Laravel\Nova\Http\Requests\NovaRequest;

trait ShouldBackToParent {
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        $viaResourceId = $request->viaResourceId;
        $resource = $request->viaResource;
        return "/resources/$resource/$viaResourceId?tab=" . $request->resource;
    }
}
