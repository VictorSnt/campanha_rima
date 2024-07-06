<?php
namespace App\Controllers;

require_once realpath(__DIR__ . '/../controllers/BaseController.php');
require_once realpath(__DIR__ . '/../repository/UserRepository.php');
require_once realpath(__DIR__ . '/../util/AuthChecker.php');
require_once realpath(__DIR__ . '/../util/Paginator.php');
require_once realpath(__DIR__ . '/../util/Validator.php');
require_once realpath(__DIR__ . '/../util/Formater.php');
require_once realpath(__DIR__ . '/../util/Cacher.php');


use App\Controllers\BaseController;
use App\Repository\UserRepository;
use CoffeeCode\Router\Router;
use App\Util\AuthChecker;
use App\Util\Validator;
use App\Util\Paginator;
use App\Util\Formater;
use App\Util\Cacher;

class AdminController extends BaseController
{
    private Router $router;
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    public function listSubscriptions($data)
    {
        if (!AuthChecker::isAuth($_SESSION)) $this->router->redirect("/auth");

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $resultsPerPage = $_ENV['RESULTS_PER_PAGE'];
        $cacheKey = "subscriptions_page_{$currentPage}_per_page_{$resultsPerPage}.cache";
        $cacher = new Cacher($cacheKey);
        $response = $cacher->getCachedResponse();
        
        if (!$response){
            $paginator = new Paginator($resultsPerPage, $currentPage);
            $userModel = new UserRepository();
            $users = $userModel->findCustomers();
            $response = $paginator->getPaginatedData($users);
            $cacher->setCacheResponse($response);
        }
        if (is_array($response) && count($response) >= 2) {
            $users = $response['data'];
            $totalPages = $response['totalPages'];
            $totalResults = $response['totalResults'];
            $users = Formater::formatDates($users, "created_at");
        }
        $view = realpath(__DIR__ . "/../views/user_list.php");
        $this->render($view, 
            [
                'totalPages' => $totalPages,
                'currentPage' => $currentPage,
                'totalResults' => $totalResults,
                'users'  => $users
            ]
        );
    }


    public function customerNotified($data)
    {
        if (!AuthChecker::isAuth($_SESSION)) $this->router->redirect("/auth");

        $cpf = isset($_POST['cpf'])? $_POST['cpf'] : null;
        $csrfOk = Validator::isCsrfTokenOk(form: $_POST, session: $_SESSION);
        if (!$csrfOk) $this->router->redirect("/auth");

        if ($cpf){  
            $userModel = new UserRepository();
            $user = $userModel->findByCpf($cpf);
            if (!$user) {
                $this->router->redirect('/error/404');
            }
            $userModel->setUserToNotified($user);
            $cacher = new Cacher();
            $cacher->clearCache();
            $this->router->redirect('/admin');
        }
    }
}