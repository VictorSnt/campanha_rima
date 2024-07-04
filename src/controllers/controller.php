<?php
namespace App\Controllers;

session_start();
require_once realpath(__DIR__ . '/../util/CodeGenerator.php');
require_once realpath(__DIR__ . '/../util/Paginator.php');
require_once realpath(__DIR__ . '/../util/Formater.php');

use App\Util\CodeGenerator;
use App\Util\Paginator;
use App\Util\Formater;
use App\Models\User;


class Controller

{
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function activateDiscount($data) 
    {
        #render view
        require_once realpath(__DIR__ . '/../views/generate_descount.php');
    }

    public function listSubscriptions($data)
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $userModel = new User();
        $paginator = new Paginator($_ENV['RESULTS_PER_PAGE'], $currentPage);
        
        $paginatedResponse = $paginator->getPaginatedData($userModel);
        $users = $paginatedResponse['data'];
        $totalPages = $paginatedResponse['totalPages'];

        $users = Formater::formatDates($users, "created_at");
        
        require realpath(__DIR__ . "/../views/user_list.php");
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
                $errorMessage = $user->fail()->getMessage();
                if (strpos($errorMessage, 'Duplicate entry') !== false) {
                    
                    preg_match("/for key '(\w+)'/", $errorMessage, $matches);
                    $duplicateField = $matches[1];
                    $duplicateField = str_replace('unique_', '', $duplicateField);
                    $error = "O $duplicateField Já esta cadastrado na promoção.";

                } else {
                    
                    $error = "Erro: Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.";
                }

                require realpath(__DIR__ . "/../warnings/erroCodigoJaGerado.php");
            } else {

                require realpath(__DIR__ . "/../warnings/genericErro.html.php");
            }
        }
    }

    public function handleEror($data) 
    {
        require realpath(__DIR__ . "/../warnings/404.html");
    }
}
