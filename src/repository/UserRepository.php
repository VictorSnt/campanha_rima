<?php
declare(strict_types= 1);

namespace App\Repository;

require_once realpath(__DIR__ . '/../models/User.php');

use App\Models\User;

class UserRepository
{
    private $engine;
    public function __construct()
    {
        $this->engine = new User();
    }

    public function find(): ?User
    {
        $data = $this->engine->find()->fetch(all: true);
        if (!$data) return null;
        return $data;
    }

    public function findById(int $id): ?User
    {
        $data = $this->engine->findById($id)->fetch(all: true);
        if (!$data) return null;
        return $data;
    }

    public function findByDiscountCode(string $code): ?User
    {
        
        $data = $this->engine->find("discount_code = :code", "code=$code")->fetch(all: true);
        if (!$data) return null;
        return $data;
    }
    
    public function createAndRenderResponse(array $data)
    {   
        $this->engine->full_name = $data['name'];
        $this->engine->cpf = $data['cpf'];
        $this->engine->phone = $data['phone'];
        $this->engine->discount_code = $data['discount_code'];

        if ($this->engine->save()) {
            return ["view" => realpath(__DIR__ . "/../views/show_code.php"), "error" => null];
        }else{
            if ($this->engine->fail()->getCode() === '23000' ) {
                $errorMessage = $this->engine->fail()->getMessage();
                if (strpos($errorMessage, 'Duplicate entry') !== false) {
                    
                    preg_match("/for key '(\w+)'/", $errorMessage, $matches);
                    $duplicateField = $matches[1];
                    $duplicateField = str_replace('unique_', '', $duplicateField);
                    $error = "O $duplicateField Já esta cadastrado na promoção.";
                    return ["view" => realpath(__DIR__ . "/../warnings/erroCodigoJaGerado.php"), "error" => $error];
                } else {
                    
                    $error = "Erro: Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.";
                    return ["view" => realpath(__DIR__ . "/../warnings/genericErro.html.php"), "error" => $error];
                }
            }
        }
    }
}