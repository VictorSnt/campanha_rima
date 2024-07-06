<?php
declare(strict_types= 1);

namespace App\Repository;

require_once realpath(__DIR__ . '/../models/User.php');

use App\Models\User;
use PDO;
use PDOException;

class UserRepository
{
    private $engine;
    public function __construct()
    {
        $this->engine = new User();
    }

    public function find(): ?array
    {   
        $data = $this->engine->find()->fetch(all: true);
        if (!$data) return null;
        return $data;
    }

    public function findCustomers(): ?array
    {   $negative = 0;
        $data = $this->engine->find("is_admin = :negative", "negative=$negative")->fetch(all: true);
        if (!$data) return null;
        return $data;
    }

    public function findById(int $id): ?User
    {
        $data = $this->engine->findById($id)->fetch();
        
        if (!$data) return null;
        return $data;
    }

    public function findByDiscountCode(string $code): ?User
    {
        
        $data = $this->engine->find("discount_code = :code", "code=$code")->fetch(all: true);
        if (!$data) return null;
        return $data;
    }
    
    public function findByCpf(string $cpf): ?User
    {
        $data = $this->engine->find("cpf = :userCpf", "userCpf=$cpf")->fetch();
        if (!$data) return null;
        
        return $data;
    }
        
    public function setUserToNotified(User $user): void
    {
        $user->notified = true;
        $user->save();
    }
    public function createOrFail(array $data): ?PDOException
    {   
        $this->engine->full_name = $data['name'];
        $this->engine->cpf = $data['cpf'];
        $this->engine->phone = $data['phone'];
        $this->engine->discount_code = $data['discount_code'];

        if ($this->engine->save()) {
            return null;
        }
        return $this->engine->fail();
    }
}