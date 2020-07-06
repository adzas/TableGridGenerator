<?php

namespace MyLib\Classes\Formatter;

use MyLib\Classes\Alert;
use DateTime;
use MyLib\Interfaces\DataType;

class DateTimeType extends DateType implements DataType
{
    /**
     * DateTimeType - formatuje date i czas. 
     * Możliwość wybrania formatu (zarówno dayt jak i godziny).
     */
    public function __construct(array $sets = null) {
        $this->dateFormat = $sets['dateTimeFormat'];
    }
}
