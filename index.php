<?php
require_once realpath(__DIR__ . '/src/database/DatabaseHandler.php');

use App\Database\DatabaseHandler;

$database = new DatabaseHandler();

if ($database->error) {
    var_dump($database->error->getMessage());
}else{
    var_dump($database->conn);
}