<?php
declare(strict_types= 1);

require_once realpath(__DIR__ . "/vendor/autoload.php");
require_once realpath(__DIR__ . "/src/controllers/controller.php");

use CoffeeCode\Router\Router;

$router = new Router(projectUrl: $_ENV['PROJECT_URL']);
$router->namespace("App\Controllers");


$router->group(group: null);
$router->get(route: "/ativar_desconto", handler: "Controller:activateDiscount");
$router->get(route: '/listar_inscricoes', handler: "Controller:listSubscriptions");
$router->post(route: '/gerar_codigo', handler: "Controller:generateCode");


$router->group(group: "/error");
$router->get(route:"/{errcode}", handler: "Controller:handleEror");

$router->dispatch();


if ($router->error())
{
    $router->redirect("/error/{$router->error()}");
}