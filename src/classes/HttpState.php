<?php

namespace MyLib\Classes;
use MyLib\Interfaces\State;

class HttpState implements State
{
    private static $instance;

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
        return 1;
    }

    public function getOrderBy(): string
    {
        return 'id';
    }

    public function isOrderDesc(): bool
    {
        return false;
    }

    public function isOrderAsc(): bool
    {
        return true;
    }

    public function getRowsPerPage(): int
    {
        return 9;
    }
}
    