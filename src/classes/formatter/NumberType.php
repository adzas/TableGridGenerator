<?php

namespace MyLib\Classes\Formatter;

use MyLib\Interfaces\DataType;

class NumberType implements DataType
{
    protected $dec;
    protected $precision;
    protected $mode;
    protected $constDecimalPlacesAway;

    public function __construct(array $sets = null) {
        $this->dec = $sets['dec'];
        $this->precision = $sets['precision'];
        $this->mode = $sets['mode'];
        $this->constDecimalPlacesAway = $sets['constDecimalPlacesAway'];
    }

    public function format(string $value): string
    {
        $number = number_format($value, $this->precision, $this->dec, ' ');
        return round($number, $this->constDecimalPlacesAway);
    }

    public function setRound(bool $var = false): NumberType
    {
        return $this;
    }
}
