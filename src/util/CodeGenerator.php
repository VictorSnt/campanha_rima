<?php
class CodeGenerator {
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
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

            $sql = "SELECT id FROM users WHERE discount_code = :discount_code";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':discount_code', $codigoAleatorio);
            $stmt->execute();
            $result = $stmt->fetch();

            if (!$result) {
                $newCode = true;
            }
        }
        return $codigoAleatorio;
    }
        
    
}
    