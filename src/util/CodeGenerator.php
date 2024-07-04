<?php
declare(strict_types=1);

namespace App\Util;

require_once realpath(__DIR__ . "/../models/User.php");

use App\Models\User;

class CodeGenerator {
    private User $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }
    public function generateCode(): string
    {
        $newCode = false;
        $codigoAleatorio = '';

        while (!$newCode) {
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $comprimentoCaracteres = strlen($caracteres);
            $codigoAleatorio = '';

            for ($i = 0; $i < 6; $i++) {
                $indiceAleatorio = rand(0, $comprimentoCaracteres - 1);
                $codigoAleatorio .= $caracteres[$indiceAleatorio];
            }
            $result = $this->userModel->find("discount_code = :code", "code=$codigoAleatorio")->fetch();
            
            if (!$result) {
                $newCode = true;
            }
        }
        return $codigoAleatorio;
    }
        
    
}
    