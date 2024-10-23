<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
use App\Nova\Metrics\Members;
use App\Nova\Metrics\Attendances;
use App\Nova\Metrics\MembersPerStatus;

class Progress extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            Members::make(),
            MembersPerStatus::make(),
            Attendances::make(),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'progress';
    }
}
