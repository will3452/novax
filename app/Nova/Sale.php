<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Sale extends Transaction
{
    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->type != 'Client';
    }
    public static $model = \App\Models\Sale::class;

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function actions(Request $request)
    {
        return [
            new DownloadExcel(),
        ];
    }
}
