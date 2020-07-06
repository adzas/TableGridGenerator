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

    public function addDateTimeColumn(
        string $name, 
        string $dateTimeFormat = 'Y-m-d h:i:s'
    ): DefaultConfig {
        $dataType = (new DataTypeFormatter)
            ->setType('DateTimeType')
            ->setDateTimeFormat($dateTimeFormat);

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType)
            ->withAlign('left');

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    public function addDateColumn(
        string $name, 
        string $dateFormat = 'Y-m-d'
    ): DefaultConfig {
        $dataType = (new DataTypeFormatter)
            ->setType('DateType')
            ->setDateFormat($dateFormat);

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType)
            ->withAlign('left');

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    public function addImageColumn(
        string $name = null, 
        string $widthImage = '16px', 
        string $heightImage = '16px'
    ): DefaultConfig {
        $dataType = (new DataTypeFormatter)
            ->setType('ImageType')
            ->setWidthImage($widthImage)
            ->setHeightImage($heightImage);

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType)
            ->withAlign('center');

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    public function addLinkColumn(
        string $name, 
        string $typeLink = 'a', 
        string $classLink = 'bg-primary'
    ): DefaultConfig {
        $dataType = (new DataTypeFormatter)
            ->setType('LinkType')
            ->setTypeLink($typeLink)
            ->setClassLink($classLink);

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType)
            ->withAlign('left');

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    /**
     * Dodaje prostą kolumnę numeryczną INT
     */
    public function addIntColumn(string $name): DefaultConfig
    {
        $dataType = (new DataTypeFormatter)
            ->setType('NumberType')
            ->setDecimal('')
            ->setPrecision(0)
            ->setMode(PHP_ROUND_HALF_UP)
            ->setConstDecimalPlacesAway(true);

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType)
            ->withAlign('center');

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
        string $decimal = '.',
        int $precision = 2,
        string $mode = 'HALF_UP',
        bool $constDecimalPlacesAway = true
    ): DefaultConfig {
        $dataType = (new DataTypeFormatter)
            ->setType('NumberType')
            ->setDecimal($decimal)
            ->setPrecision($precision)
            ->setMode($mode)
            ->setConstDecimalPlacesAway($constDecimalPlacesAway);

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType)
            ->withAlign('right');

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
            ->withDataType($dataType)
            ->withAlign('left');

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }

    /**
     * ustawia kolumną z walutą
     */
    public function addCurrencyColumn(
        string $name, 
        string $currency = 'USD',
        string $separator = '.',
        int $precision = 2,
        bool $withoutDecimalPlaces = false
    ): DefaultConfig {
        $dataType = (new DataTypeFormatter)
            ->setType('MoneyType')
            ->setCurrency($currency)
            ->setSeparator($separator)
            ->setPrecisionMoney($precision)
            ->setWithoutDecimalPlaces($withoutDecimalPlaces);

        $column = (new TableColumn)
            ->withLabel($name)
            ->withDataType($dataType)
            ->withAlign('right');

        $this->addColumn(
            $this->key++,
            $column
        );
        return $this;
    }
}
