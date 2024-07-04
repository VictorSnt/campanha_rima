<?php
declare(strict_types=1);

namespace App\Util;

use Datetime;

class Formater
{
    public static function formatDates(array $objs, string $objDateProp): array
    {
        foreach ($objs as $obj) 
        {
            $dateObj = new DateTime($obj->$objDateProp);
            $obj->$objDateProp = $dateObj->format('d/m/Y H:i:s');
        }
        return $objs;
    }
    
}