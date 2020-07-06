<?php

namespace MyLib\Classes\Formatter;

use MyLib\Classes\Alert;
use MyLib\Interfaces\DataType;

class MoneyType implements DataType
{
    /**
     * Money Type - typ do formatowania wartości pieniężnych. 
     * Działa podobnie do NumberType, 
     * jednak dodatkowo na końcu wyświetla walutę. 
     * Możliwość skonfigurowania: 
     * dowolnego separatora (tysięcy i miejsca dziesiętnego)
     * oraz wyświetlania miejsc dziesiętnych (można wyłączyć aby nie pokazywać groszy).
     */
    protected $currency;
    protected $separator;
    protected $precision;
    protected $withoutDecimalPlaces;

    public function __construct(array $sets = null) {
        $this->currency = $sets['currency'];
        $this->separator = $sets['separator'];
        $this->precision = $sets['precision'];
        $this->withoutDecimalPlaces = $sets['withoutDecimalPlaces'];
    }

    public function format(string $value): string
    {
        if (floatval($value) != 0) {
            if ($this->withoutDecimalPlaces) {
                $number = number_format($value, 10, '.', ',');
                $number = round($number, $this->precision);
            } else {
                $number = $value;
            }
            return number_format($number, $this->precision, ',', $this->separator) . ' ' . $this->currency;
        } else {
            Alert::warning('Money format incorrect');
            return '';
        }
    }
}
