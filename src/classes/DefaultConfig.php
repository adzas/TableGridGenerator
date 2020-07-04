<?php

namespace MyLib\Classes;

use MyLib\Classes\TableColumn;
use MyLib\Interfaces\Config;

class DefaultConfig implements Config
{
    protected $columns = [];

    public function addColumn(string $key, TableColumn $column): Config
    {
        $this->columns[$key] = $column;
        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function addIntColumn(String $name)
    {
        $this->columns[] = new TableColumn('number', $name);
        return $this;
    }

    public function addTextColumn(String $name)
    {
        $this->columns[] = new TableColumn('text', $name);
        return $this;
    }

    public function addCurrencyColumn(String $name, String $currency)
    {
        $this->columns[] = new TableColumn('currency', $name);
        return $this;
    }
}
