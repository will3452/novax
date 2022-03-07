<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class ParentClass extends User
{
    public static $model = \App\Models\ParentClass::class;

    public static $displayInNavigation = false;

    public static function availableForNavigation(Request $request)
    {
        return false;
    }
}
