<?php
namespace App\Commons\Helpers;

class StringHelper
{
    public static function camelConvert(string $str)
    {
        if (function_exists('camel_case')) {
            return camel_case();
        } else {
            return str_replace(' ', '', lcfirst(ucwords(str_replace(['-', '_'], ' ', $str))));
        }
    }
}
