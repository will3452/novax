<?php
namespace App\Helpers;

class ReferenceHelper
{
    public static function format($id)
    {
        return now()->format('Ymd') . '-' . $id;
    }
    public static function generate($prefix = "REF", $id = 1)
    {
        $format = self::format($id);
        return "$prefix-$format";
    }
}
