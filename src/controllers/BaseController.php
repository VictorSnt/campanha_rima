<?php
namespace App\Controllers;

class BaseController
{
    public function render($view, array $args = [])
    {
        return require_once $view;
    }
}