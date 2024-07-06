<?php
declare(strict_types= 1);

require_once realpath(__DIR__ . "/vendor/autoload.php");
require_once realpath(__DIR__ . "/src/controllers/Controller.php");
require_once realpath(__DIR__ . "/src/controllers/AdminController.php");
require_once realpath(__DIR__ . "/src/controllers/AuthController.php");

use CoffeeCode\Router\Router;

session_start();
$router = new Router(projectUrl: $_ENV['PROJECT_URL']);
$router->namespace("App\Controllers");


$router->group(group: null);
$router->get(route: "/ativar_desconto", handler: "Controller:activateDiscount");
$router->post(route: '/gerar_codigo', handler: "Controller:generateCode");


$router->group(group: "auth")->namespace("App\Controllers");
$router->get(route: "/", handler: "AuthController:loginForm");
$router->post(route: "/login", handler: "AuthController:login");
$router->get(route: "/logout", handler: "AuthController:logout");


$router->group(group: "admin")->namespace("App\Controllers");
$router->get(route: "/", handler: "AdminController:listSubscriptions");
$router->post(route: "/customer_notified", handler: "AdminController:customerNotified");

$router->group(group: "error")->namespace("App\Controllers");
$router->get(route:"/{errcode}", handler: "Controller:handleError");


$router->dispatch();

if ($router->error())
{
    $router->redirect("error/{$router->error()}");
}