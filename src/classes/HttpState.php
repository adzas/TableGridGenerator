<?php

namespace MyLib\Classes;
use MyLib\Interfaces\State;

class HttpState implements State
{
    private static $instance;
    private $rowsPerPage = 9;
    private $currentPage = 1;
    private $orderBy = 'id';
    private $orderDesc = false;
    private $orderAsc = true;

    static function create()
    {
        if(isset($_GET))
        {
            //$_GET['page'];
            //$_GET['filter'];
        }
     
        if(!self::$instance) {
            self::$instance = new self();
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
    