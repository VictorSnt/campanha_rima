<?php
namespace App\Controllers;

require_once realpath(__DIR__ . '/../repository/UserRepository.php');
require_once realpath(__DIR__ . '/../util/Paginator.php');
require_once realpath(__DIR__ . '/../util/Formater.php');

use App\Repository\UserRepository;
use CoffeeCode\Router\Router;
use App\Util\Paginator;
use App\Util\Formater;

class AdminController
{
    private Router $router;
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    public function listSubscriptions($data)
    {
        
        if (!isset($_SESSION["user"])) {
            $this->router->redirect("/auth");
            exit;
        }

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $paginator = new Paginator($_ENV['RESULTS_PER_PAGE'], $currentPage);
        $userModel = new UserRepository();
        
        $users = $userModel->find();
        
        $response = $paginator->getPaginatedData($users);
        
        if (is_array($response) && count($response) >= 2){
            $users = $response['data'];
            $totalPages = $response['totalPages'];
            $users = Formater::formatDates($users, "created_at");
        }

        require_once realpath(__DIR__ . "/../views/user_list.php");
        exit();
        
    }
}