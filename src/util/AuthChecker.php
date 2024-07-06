<?php
namespace App\Util;
class AuthChecker 
{
    public static function isAuth($session)
    {
        if (isset($session["user"])) {
            return true;
        }
        return false;
    }
}