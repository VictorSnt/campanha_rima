<?php
namespace App\Controllers;

session_start();
require_once realpath(__DIR__ . '/../repository/UserRepository.php');
require_once realpath(__DIR__ . '/../util/CodeGenerator.php');
require_once realpath(__DIR__ . '/../util/Paginator.php');
require_once realpath(__DIR__ . '/../util/Formater.php');


use App\Repository\UserRepository;
use App\Util\CodeGenerator;
use App\Util\Paginator;
use App\Util\Formater;
use Exception;

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
        try 
        {
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $paginator = new Paginator($_ENV['RESULTS_PER_PAGE'], $currentPage);
            $userModel = new UserRepository();
            $users = $userModel->find();
            $response = $paginator->getPaginatedData($users);
            if (is_array($response) && count($response) >= 2) 
            {
                $users = $response['data'];
                $totalPages = $response['totalPages'];
                $users = Formater::formatDates($users, "created_at");
            }
            require realpath(__DIR__ . "/../views/user_list.php");
        }
        catch(Exception $e)
        {
            // Trate a exceção ao buscar dados
            echo "Erro ao buscar dados de inscrição: " . $e->getMessage();
            // Ou redirecionar para uma página de erro personalizada
            // header("Location: /error/database_error.php");
            exit;
        }
    }
    
    public function generateCode($data) 
    {

        $userRepository = new UserRepository();
        $codeGenerator = new CodeGenerator();
        $discount_code = $codeGenerator->generateCode();

        $name = $_POST['name'];
        $first_name = explode(' ', $name)[0];
        $data = array_merge($_POST, ["discount_code" => $discount_code]);
        $response = $userRepository->createAndRenderResponse($data);
        $error = $response["error"];
        $view = $response["view"];
        include_once $view;
    }

    public function handleEror($data) 
    {
        require realpath(__DIR__ . "/../warnings/404.html");
    }
}
