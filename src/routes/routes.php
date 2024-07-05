<?php

$root = dirname($_SERVER['SCRIPT_FILENAME'], 1);
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/campanha_rima/login' => 'login_form',
    '/campanha_rima/login/' => 'login_form',
    '/campanha_rima/ativar_desconto' => 'activate_discount',
    '/campanha_rima/ativar_desconto/' => 'activate_discount',
    '/campanha_rima/gerar_codigo' => 'generate_code',
    '/campanha_rima/gerar_codigo/' => 'generate_code',
    '/campanha_rima/listar_inscritos' => 'get_users',
    '/campanha_rima/listar_inscritos/' => 'get_users',
    '/campanha_rima/login_user' => 'user_login',
    '/campanha_rima/login_user/' => 'user_login'
];

if (array_key_exists($uri, $routes)) {
    require_once($root . "/controllers/Controller.php");
    $controller = new Controller();
    $method = $routes[$uri];
    $controller->$method();
}

else {
    include_once($root . "/warnings/404.html");
}
