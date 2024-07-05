<?php
namespace App\Util;

class Validator 
{
    public static function isCsrfTokenOk($form, $session): bool
    {
        $sessionToken = $session['csrf_token'];
        $formToken = $form['csrf_token'];
        if($sessionToken !== $formToken) return false;
        return true;
    }
}