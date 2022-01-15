<?php

namespace App\Helpers;

class Contact {
    public static function parse($string): array
    {
       return preg_split("/ ?[!\/|,] ?/", $string);
    }
}
