<?php

namespace MyLib\Interfaces;

use MyLib\Classes\TableColumn;

interface Config
{
    /**
     * Dodaje nową kolumną do DataGrid.
     */
    public function addColumn(string $key, TableColumn $column): Config;

    /**
     * Zwraca wszystkie kolumny dla danego DataGrid.
     */
    public function getColumns(): array;
}
