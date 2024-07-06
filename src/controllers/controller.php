<?php
namespace App\Controllers;

require_once realpath(__DIR__ . '/../controllers/BaseController.php');
require_once realpath(__DIR__ . '/../repository/UserRepository.php');
require_once realpath(__DIR__ . '/../util/CodeGenerator.php');
require_once realpath(__DIR__ . '/../util/Validator.php');
require_once realpath(__DIR__ . '/../util/Formater.php');


use App\Controllers\BaseController;
use App\Repository\UserRepository;
use CoffeeCode\Router\Router;
use App\Util\CodeGenerator;
use App\Util\Validator;
use App\Util\Formater;

class Controller extends BaseController

{
    private Router $router;
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function activateDiscount($data) 
    {
        $view = realpath(__DIR__ . '/../views/generate_descount.php');
        $this->render($view);
    }

    public function generateCode($data) 
    {
        $csrfOk = Validator::isCsrfTokenOk(form: $_POST, session: $_SESSION);
        if (! $csrfOk) $this->router->redirect("/auth");
        
        $userRepository = new UserRepository();
        $codeGenerator = new CodeGenerator();
        
        $discount_code = $codeGenerator->generateCode();

        $name = $_POST['name'];
        $first_name = explode(' ', $name)[0];
        $data = array_merge($_POST, ["discount_code" => $discount_code]);
        
        $fail = $userRepository->createOrFail($data);

        if ($fail){
            $DbUniqueFildDuplicatedErrorCode = '23000';
            if ($fail->getCode() === $DbUniqueFildDuplicatedErrorCode ) {
                $errorMessage = $fail->getMessage();
                $error = Formater::formatIntegritErrorMsg($errorMessage);
                $view =  realpath(__DIR__ . "/../warnings/erroCodigoJaGerado.php");
                $this->render($view, ['error' =>$error]);
                exit();
            }else{
                $error = "Erro: Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.";
                $view =  realpath(__DIR__ . "/../warnings/genericErro.html.php");
                $this->render($view, ['error' =>$error]);
                exit();
            }
        }
        $view =  realpath(__DIR__ . "/../views/show_code.php");
        $this->render($view, 
            [
                'first_name' => $first_name, 
                'discount_code' => $discount_code
            ]
        );
        exit();
    }
    
    public function handleError($data) 
    {
        $view =  realpath(__DIR__ . "/../warnings/404.html");
        $this->render($view);
    }
}
