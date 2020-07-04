<?php

namespace MyLib\Interfaces;

use MyLib\Classes\TableColumn;
use MyLib\Classes\DataTypeFormatter;

interface Column
{
    /**
     * Zmienia tytuł kolumny, który będzie widoczny jako nagłówek.
     */
    public function withLabel(string $label): TableColumn;

    public function getLabel(): string;

    /**
     * Ustawia typ danych dla kolumny.
     */
    public function withDataType(DataTypeFormatter $type): TableColumn;

    public function getDataType(): DataTypeFormatter;

    /**
     * Ustawienie wyrównania treści znajdujących się w kolumnie.
     */
    public function withAlign(string $align): TableColumn;

    public function getAlign(): string;
}
