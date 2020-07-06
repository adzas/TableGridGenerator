<?php

namespace MyLib\Classes\Formatter;

use MyLib\Interfaces\DataType;

class RawType implements DataType
{
    /**
     * typ do formatowania wartości liczbowych. 
     * Domyślne formatowanie: tysiące oddzielone spacjami, 
     * miejsce dziesiętne przecinkiem, dwa miejsca po przecinku zawsze widoczne. 
     * Możliwość skonfigurowania: 
     * dowolnego separatora (tysięcy i miejsca dziesiętnego), 
     * precyzji wyświetlania, 
     * metody zaokrąglania, 
     * włączenia / wyłączenia stałej ilości miejsc po przecinku.
     */
    protected $constDecimalPlacesAway;
    protected $dec;
    protected $mode;
    protected $precision;

    public function __construct(array $sets = null) {
        $this->constDecimalPlacesAway = $sets['constDecimalPlacesAway'];
        $this->dec = $sets['dec'];
        $this->mode = $sets['mode'];
        $this->precision = $sets['precision'];
    }

    public function format(string $value): string
    {
        $number = number_format($value, 10, '.', ',');
        $number = round($number, $this->constDecimalPlacesAway);
        return number_format($value, $this->precision, $this->dec, ' ');
    }
}
