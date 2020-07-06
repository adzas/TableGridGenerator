<?php

namespace MyLib\Classes\Formatter;

use MyLib\Classes\Alert;
use MyLib\Interfaces\DataType;

class DateType implements DataType
{
    /**
     * DateType - formatuje date. 
     * Możliwość wyboru formatowania daty.
     */
    protected $dateFormat;

    public function __construct(array $sets = null) {
        $this->dateFormat = $sets['dateFormat'];
    }

    public function format(string $value): string
    {
        return $this->renderDate($value);
    }

    public function renderDate(string $date)
    {
        if ($this->isValidTimeStamp($date)) {
            return date($this->dateFormat, intval($date));
        } else {
            Alert::warning();
            return '';
        }
    }
    
    public function isValidTimeStamp(string $timestamp)
    {
        return ((string) (int) $timestamp === $timestamp) 
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
}
