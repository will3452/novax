<?php

namespace App;

use App\Models\Category;
use App\Models\Product;
use App\Nova\Metrics\AverageSales;
use App\Nova\Metrics\MonthlySales;
use App\Nova\Metrics\ProductsPerCategories;
use App\Nova\Metrics\Sales;
use App\Nova\Metrics\SalesPerUser;
use Coroowicaksono\ChartJsIntegration\PieChart;

class DashboardChart
{
    public static function randomPart()
    {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    public static function randomHex($amount = 3)
    {
        $_result = "";
        for ($i = 0 ; $i < $amount; $i++) {
            $_result .= self::randomPart();
        }
        return $_result;
    }
    public static function categories()
    {
        return Category::get()->pluck('description');
    }

    public static function categoriesData()
    {
        $data = [];
        $categories = self::categories();

        foreach ($categories as $c) {
            $data[] = Product::whereCategory($c)->count();
        }
        return $data;
    }

    public static function getColors($count)
    {
        $colors = [];
        for ($i=0; $i < $count; $i++) {
            $colors[] = "#" . self::randomHex();
        }

        return $colors;
    }

    public static function init()
    {
        return [
            ProductsPerCategories::make(),
            SalesPerUser::make(),
            Sales::make(),
            AverageSales::make(),
        ];
    }
}
