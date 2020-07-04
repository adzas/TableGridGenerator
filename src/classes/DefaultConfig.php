<?php

namespace MyLib\Classes;

use MyLib\Classes\TableColumn;
use MyLib\Interfaces\Config;

class DefaultConfig implements Config
{
    protected $key = 0;
    protected $columns = [];

    /**
     * Główna funkcja odpowiedzialna za dodawanie kolumny
     */
    public function addColumn(string $key, TableColumn $column): Config
    {
        $this->columns[$key] = $column;
        return $this;
    }

    /**
     * Funkcja zwraca wszytskie zadeklarowane kolumny tabeli
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * ustawia kolumnę numeryczną
     */
    public function addIntColumn(String $name)
    {
        $dataType = (new DataTypeFormatter)
            ->setType('NumberType');

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType);

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    /**
     * ustawia kolumną typu tekstowego
     */
    public function addTextColumn(String $name)
    {
        $dataType = (new DataTypeFormatter)
            ->setType('TextType');

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType);

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    /**
     * ustawia kolumną z walutą
     */
    public function addCurrencyColumn(String $name, String $currency)
    {
        $dataType = (new DataTypeFormatter)
            ->setType('MoneyType')
            ->setCurrency($currency);

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType);

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }
}
