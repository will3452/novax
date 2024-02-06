<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
use App\Nova\Metrics\Batches;
use App\Nova\Metrics\Genders;
use App\Nova\Metrics\WorkTypes;
use App\Nova\Metrics\AlumniPerPrograms;
use App\Nova\Metrics\EmploymentStatuses;
use App\Nova\Metrics\ProfessionIsAligned;

class Statistics extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            Genders::make(), 
            EmploymentStatuses::make(), 
            ProfessionIsAligned::make(), 
            Batches::make(), 
            AlumniPerPrograms::make(), 
            WorkTypes::make(), 
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'statistics';
    }
}
