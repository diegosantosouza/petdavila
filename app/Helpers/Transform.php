<?php

namespace App\Helpers;

class Transform
{
    public static function convertStringToDouble($param)
    {
        return str_replace(',', '.', str_replace('.', '', $param));
    }

    public static function convertStringToDate($param)
    {
        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    public static function convertToDateTime($param)
    {
        return (new \DateTime($param))->format('d-m-Y H:i:s');
    }

    public static function convertToDate($param)
    {
        return (new \DateTime($param))->format('d-m-Y');
    }
}
