<?php

session_start();


require dirname(__FILE__, 2) . '\\configs\\DatabaseHandler.php';
require dirname(__FILE__, 2) . '\\util\\CodeGenerator.php';

class Controller
{
    
    public function activate_discount() {

        include_once(dirname(__FILE__, 2) . "\\views\\generate_descount.php");
    }

    public function generate_code() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new DatabaseHandler();
            $codeGenerator = new CodeGenerator($db);
            $discount_code = $codeGenerator->generateCode();
            $conn = $db->getConnection();
            $name = $_POST['name'];
            $first_name = explode(' ', $name)[0];
            try {
                $conn->beginTransaction();
                $sql = "INSERT INTO users (full_name, cpf, phone, discount_code) " .
                    "VALUES (:full_name, :cpf, :phone, :discount_code)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':full_name', $_POST['name']);
                $stmt->bindParam(':cpf', $_POST['cpf']);
                $stmt->bindParam(':phone', $_POST['phone']);
                $stmt->bindParam(':discount_code', $discount_code);
                $stmt->execute();
                $conn->commit();
                include_once(dirname(__FILE__, 2) . "\\views\\show_code.php");

            } catch (PDOException $e) {
                
                if ($e->getCode() === '23000') {
                    include_once(dirname(__FILE__, 2) . "\\warnings\\erroCodigoJaGerado.html");
                } else {
                    $conn->rollback();
                    error_log("Erro ao inserir usuário: " . $e->getMessage());
                    include_once(dirname(__FILE__, 2) . "\\warnings\\erroCodigoJaGerado.html");

                }
            }
        }
    }

    public function get_users() {
        if (!$_SESSION["login"]) {
            header("Location: login");
            
        }
        $db = new DatabaseHandler();
        $conn = $db->getConnection();
        $sql = "SELECT full_name, cpf, phone, discount_code, created_at FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        include_once(dirname(__FILE__, 2) . "\\views\\user_list.php");
    }
    
    public function login_form() {

        include_once(dirname(__FILE__, 2) . "\\views\\login.php");
    }
    public function user_login() {
        
        if($_POST['username'] == 'cfmadmin' && $_POST['password'] == 'cfmadmin') {
            $_SESSION["login"] = true;
            header("Location: listar_inscritos");
        }
        else {
            echo 'Credenciais erradas';
        }
    }
}
