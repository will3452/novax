<?php

namespace App\Nova\Traits;

use Illuminate\Http\Request;

trait HideTrait
{
    public static function availableForNavigation(Request $request)
    {
        return ! in_array(auth()->user()->type, static::hideToUserType);
    }
}
