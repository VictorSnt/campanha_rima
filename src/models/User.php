<?php
declare(strict_types= 1);
namespace App\Models;

require_once realpath(__DIR__ . "/../../vendor/autoload.php");

use CoffeeCode\DataLayer\DataLayer;
use stdClass;
class User extends DataLayer 
{
    public function __construct() 
    {
        parent::__construct(
            entity: "users", 
            required:["full_name", "cpf", "phone"], 
            timestamps: false
        );
    }
    public function __toString(): string
    {
        return $this->full_name ?? 'Undefined User';
    }
    
}
