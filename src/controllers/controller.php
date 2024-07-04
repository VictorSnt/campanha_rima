<?php
namespace App\Controllers;

session_start();
require_once realpath(__DIR__ . '/../util/CodeGenerator.php');
require_once realpath(__DIR__ . '/../util/Paginator.php');
require_once realpath(__DIR__ . '/../util/Formater.php');
require_once realpath(__DIR__ . '/../repository/UserRepository.php');

use App\Util\CodeGenerator;
use App\Util\Paginator;
use App\Util\Formater;
use App\Models\User;
use App\Repository\UserRepository;


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
