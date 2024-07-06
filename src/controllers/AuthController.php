<?php
namespace App\Controllers;


require_once realpath(__DIR__ . '/../controllers/BaseController.php');
require_once realpath(__DIR__ . '/../repository/UserRepository.php');
require_once realpath(__DIR__ . '/../util/Validator.php');


use App\Controllers\BaseController;
use App\Repository\UserRepository;
use CoffeeCode\Router\Router;
use App\Util\Validator;


class AuthController extends BaseController
{   
    private Router $router;
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    public function loginForm($data)
    {
        $view = realpath(__DIR__ . "/../views/login.php");
        $this->render($view);
    }

    public function login($data)
    {
        $csrfOk = Validator::isCsrfTokenOk(form: $_POST, session: $_SESSION);
        if (! $csrfOk) $this->router->redirect("/auth");
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        if ($this->checkCredentials($username, $password)) {      
            $_SESSION["user"] = $username;
            $this->router->redirect("/admin");
            
        } else {
            $this->router->redirect("/auth?error=Credenciais Invalidas");;
        }
    }

    public function logout($data)
    {
        session_destroy();
        $this->router->redirect("/auth");
    }
    
    private function checkCredentials(string $username, string $password)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findByCpf($username);
        if ($user && $user->is_admin && $password === $_ENV['SECRET']) {
            return true;
        }

        return false;
    }
}
