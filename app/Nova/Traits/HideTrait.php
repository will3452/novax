<?php

namespace App\Nova\Traits;

use App\Models\Role;
use App\Nova\Module;
use App\Nova\Room;
use App\Nova\Subject;
use Illuminate\Http\Request;

trait HideTrait
{
    public static function hideToAdmin()
    {
        $resources = [
            Module::class,
            Subject::class,
            Room::class,
        ];

        return in_array(self::class, $resources);
    }

    public static function availableForNavigation(Request $request)
    {
        if (self::hideToAdmin() && auth()->user()->hasRole(Role::SUPERADMIN)) {
            return false;
        }

        return ! in_array(auth()->user()->type, static::hideToUserType);
    }
}
