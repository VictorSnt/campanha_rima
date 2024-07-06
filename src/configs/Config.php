<?php
declare(strict_types=1);

require_once realpath(__DIR__ . "/../configs/EnvLoader.php");

use App\Config\EnvLoader;

$dotEnvPath = realpath(__DIR__ . '/../../.env');
EnvLoader::loadEnv($dotEnvPath);
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => $_ENV['DB_HOST'],
    "port" => "3306",
    "dbname" => $_ENV['DB_NAME'],
    "username" => $_ENV['DB_USER'],
    "passwd" => $_ENV['DB_PASS'],
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
