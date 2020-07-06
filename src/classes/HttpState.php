<?php

namespace MyLib\Classes;
use MyLib\Interfaces\State;

class HttpState implements State
{
    private const ROWS_PER_PAGE = 9;
    private const ORDER_BY = 'id';

    private static $instance;
    private $currentPage = 0;
    private $orderAsc = true;
    private $orderBy = self::ORDER_BY;
    private $orderDesc = false;
    private $rowsPerPage = self::ROWS_PER_PAGE;

    private function __construct(
        int $rowsPerPage = self::ROWS_PER_PAGE,
        string $orderBy = self::ORDER_BY
    ) {
        $this->rowsPerPage = $rowsPerPage;
        $this->orderBy = $orderBy;
    }

    static function create(
        int $rowsPerPage = self::ROWS_PER_PAGE,
        string $orderBy = self::ORDER_BY
    ) {
        if(!self::$instance) {
            self::$instance = new self($rowsPerPage, $orderBy);
        }
        
        if(isset($_GET))
        {
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                self::$instance->orderBy = htmlentities($_GET['sort']);
            }
            
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                self::$instance->currentPage = $_GET['page'];
            }
        }

        return self::$instance;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function isOrderDesc(): bool
    {
        return $this->orderDesc;
    }

    public function isOrderAsc(): bool
    {
        return $this->orderAsc;
    }

    public function getRowsPerPage(): int
    {
        return $this->rowsPerPage;
    }
}
    