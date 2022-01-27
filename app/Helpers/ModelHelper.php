<?php

namespace App\Helpers;

class ModelHelper
{
    /**
     * to remove the App\Models\
     *
     * @param mixed $modelString
     * @return string
     */
    public static function extract($modelString): string
    {
        return str_replace("App\Models\\", '', $modelString);
    }

    /**
     * return string with App\Models\
     *
     * @param mixed $extractedModelString
     *
     * @return string
     */
    public static function origin($extractedModelString): string
    {
        return "App\\Models\\$extractedModelString";
    }
}
