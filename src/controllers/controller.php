<?php
namespace App\Controllers;

session_start();
require_once realpath(__DIR__ . '/../util/CodeGenerator.php');

use App\Models\User;
use App\Util\CodeGenerator;

class Controller

{
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function activateDiscount($data) 
    {
        require_once realpath(__DIR__ . '/../views/generate_descount.php');
    }

    public function generateCode($data) 
    {

        $user = new User();
        $codeGenerator = new CodeGenerator($user);
        $discount_code = $codeGenerator->generateCode();

        $name = $_POST['name'];
        $first_name = explode(' ', $name)[0];

        $user->full_name = $_POST['name'];
        $user->cpf = $_POST['cpf'];
        $user->phone = $_POST['phone'];
        $user->discount_code = $discount_code;

        if ($user->save()) {
            include_once realpath(__DIR__ . "/../views/show_code.php");
        }else{
            if ($user->fail()->getCode() === '23000' ) {
                include_once realpath(__DIR__ . "/../warnings/erroCodigoJaGerado.html");
            }else{
                include_once realpath(__DIR__ . "/../warnings/genericErro.html.php");
            }
        }
    }

    public function handleEror($data) 
    {
        include_once realpath(__DIR__ . "/../warnings/404.html");
    }
}
