<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
use App\Nova\Metrics\Batches;
use App\Nova\Metrics\Genders;
use App\Nova\Metrics\WorkTypes;
use Illuminate\Support\Facades\DB;
use App\Nova\Metrics\AlumniPerPrograms;
use App\Nova\Metrics\EmploymentStatuses;
use App\Nova\Metrics\ProfessionIsAligned;
use Coroowicaksono\ChartJsIntegration\BarChart;

class Statistics extends Dashboard
{
    public static function label()
    {
        return "Career Trajectory"; 
    }
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        $records = \App\Models\ProfessionalRecord::groupBy('career')->select('career', DB::raw('count(*) as count'))->get(); 
        return [
            (new BarChart())
            ->title('Career Trajectory')
            ->animations([
                'enabled' => true,
                'easing' => 'easeinout',
            ])
            ->series($records->map(function ($i) {
                return [
                    'barPercentage' => 0.5,
                    'label' => $i->career,
                    'backgroundColor' => "#" . dechex(mt_rand(0, 0xFFFFFF)), 
                    'data' => [$i->count]
                ];
            })->all())
            // ->series(array([
            //     'barPercentage' => 0.5,
            //     'label' => 'Average Sales',
            //     'backgroundColor' => '#999',
            //     'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
            // ],[
            //     'barPercentage' => 0.5,
            //     'label' => 'Average Sales 2',
            //     'backgroundColor' => '#F87900',
            //     'data' => [40, 62, 79, 80, 90, 79, 90, 90, 90, 92, 91, 80],
            // ]))
            ->options([
                'xaxis' => [
                    'categories' => [ 'Career' ]
                ],
            ])
            ->width('3/3'),
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
