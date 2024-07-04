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
    
    
    public function getPaginatedData(?array $data): ?array {
        if (!$data) return null;
        $totalUsers = count($data);
        $offset = ($this->currentPage - 1) * $this->perPage;
        $paginatedData = array_slice($data, $offset, $this->perPage);
        $totalPages = ceil($totalUsers / $this->perPage);

        return ["data" => $paginatedData, "totalPages" => $totalPages];
    }
    
}