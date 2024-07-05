<?php
declare(strict_types=1);

namespace App\Util;

use Datetime;

class Formater
{
    public static function formatDates(?array $objs, string $objDateProp): ?array
    {   
        if (!$objs) return null;
        foreach ($objs as $obj) 
        {
            $dateObj = new DateTime($obj->$objDateProp);
            $obj->$objDateProp = $dateObj->format('d/m/Y H:i:s');
        }
        return $objs;
    }
    
    public static function formatIntegritErrorMsg(string $errorMessage): string
    {     
        preg_match("/for key '(\w+)'/", $errorMessage, $matches);
        $duplicateField = $matches[1];
        $duplicateField = str_replace('unique_', '', $duplicateField);
        $error = "O $duplicateField Já esta cadastrado na promoção.";
        return $error;
    }
    

}