<?php
declare(strict_types=1);

namespace App\Util;


class Paginator 
{   
    private $perPage;
    private $currentPage;
    private $offset;

    public function __construct(int $perPage = 3, int $currentPage)
    {
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->offset = ($this->currentPage - 1) * $this->perPage;
    }
    
    
    public function getPaginatedData($userModel): array
    {
        $totalUsers = $userModel->find()->count();
        $users = $userModel->find()->limit($this->perPage)->offset($this->offset)->fetch(true);
        $totalPages = ceil($totalUsers / $this->perPage);
        
        return ["data" => $users, "totalPages" => $totalPages];
    }
    
}