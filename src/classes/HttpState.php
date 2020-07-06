<?php

namespace MyLib\Classes;
use MyLib\Interfaces\State;

class HttpState implements State
{
    private const ROWS_PER_PAGE = 9;
    private const ORDER_BY = '';

    private static $instance;
    private $currentPage = 0;
    private $orderAsc;
    private $orderBy = self::ORDER_BY;
    private $orderDesc;
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
            if (isset($_GET['sortAsc']) && !empty($_GET['sortAsc'])) {
                self::$instance->orderBy = htmlentities($_GET['sortAsc']);
                self::$instance->orderAsc = true;
            } elseif (isset($_GET['sortDesc']) && !empty($_GET['sortDesc'])) {
                self::$instance->orderBy = htmlentities($_GET['sortDesc']);
                self::$instance->orderDesc = true;
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
        return !!$this->orderDesc;
    }

    public function isOrderAsc(): bool
    {
        return !!$this->orderAsc;
    }

    public function getOrderAscIcon()
    {
        return 
        '<svg class="bi bi-arrow-up-short" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z"></path>
            <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8 5.707 5.354 8.354a.5.5 0 1 1-.708-.708l3-3z"></path>
        </svg>';
    }

    public function getOrderDescIcon()
    {
        return 
        '<svg class="bi bi-arrow-down-short" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z"></path>
            <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"></path>
        </svg>';
    }

    public function getRowsPerPage(): int
    {
        return $this->rowsPerPage;
    }
}
    