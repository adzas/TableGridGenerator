<?php

namespace MyLib\Classes;

use MyLib\Classes\TableColumn;
use MyLib\Interfaces\Config;

class DefaultConfig implements Config
{
    protected $key = 0;
    protected $columns = [];
    protected $limitRowsForPage = 9;

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

    public function getConfig()
    {
        return $this->limitRowsForPage;
    }

    /**
     * Dodaje prostą kolumnę numeryczną INT
     */
    public function addIntColumn(string $name): DefaultConfig
    {
        $dataType = (new DataTypeFormatter)
            ->setType('NumberType')
            ->setDec('')
            ->setPrecision(0)
            ->setMode('PHP_ROUND_HALF_UP')
            ->setConstDecimalPlacesAway(true);

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
     * Dodaje kolumnę numeryczną
     */
    public function addNumberColumn(
        string $name,
        string $dec = '.',
        int $precision = 2,
        string $mode = 'PHP_ROUND_HALF_UP',
        bool $constDecimalPlacesAway = true
    ): DefaultConfig {
        $dataType = (new DataTypeFormatter)
            ->setType('NumberType')
            ->setDec($dec)
            ->setPrecision($precision)
            ->setMode($mode)
            ->setConstDecimalPlacesAway($constDecimalPlacesAway);

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
    public function addTextColumn(string $name): DefaultConfig
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
    public function addCurrencyColumn(String $name, String $currency): DefaultConfig
    {
        $dataType = (new DataTypeFormatter)
            ->setType('MoneyType');

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType);

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    public function addDateColumn(string $name = null): DefaultConfig
    {
        $dataType = (new DataTypeFormatter)
            ->setType('DateType');

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType);

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    public function addDateTimeColumn(string $name = null): DefaultConfig
    {
        $dataType = (new DataTypeFormatter)
            ->setType('DateTimeType');

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType);

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    public function addImageColumn(string $name = null): DefaultConfig
    {
        $dataType = (new DataTypeFormatter)
            ->setType('ImageType');

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType);

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    public function addLinkColumn(string $name = null): DefaultConfig
    {
        $dataType = (new DataTypeFormatter)
            ->setType('LinkType');

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType);

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    public function limitRowsForPage(int $limit)
    {
        $this->limitRowsForPage = $limit;
    }
}
