<?php
declare(strict_types=1);

namespace App\Database;

require_once realpath(__DIR__ . "/../../vendor/autoload.php");

use CoffeeCode\DataLayer\Connect;
use PDO;
use PDOException;

class DatabaseHandler
{
    public ?PDO $conn;
    public ?PDOException $error;

    public function __construct()
    {
        $this->conn = Connect::getInstance();
        $this->error = Connect::getError();
    }

}
