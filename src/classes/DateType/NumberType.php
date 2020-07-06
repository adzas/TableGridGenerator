<?php

namespace MyLib\Classes\Formatter;

use MyLib\Classes\Alert;
use MyLib\Interfaces\DataType;

class NumberType implements DataType
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
    protected $decimal;
    protected $mode;
    protected $precision;

    public function __construct(array $sets = null) {
        $this->constDecimalPlacesAway = $sets['constDecimalPlacesAway'];
        $this->decimal = $sets['decimal'];
        $this->mode = $sets['mode'];
        $this->precision = $sets['precision'];
    }

    public function format(string $value): string
    {
        if (floatval($value) != 0) {
            $number = number_format($value, 10, '.', ',');
            $number = round($number, $this->precision, $this->getMode());
            if ($this->constDecimalPlacesAway) {
                return number_format($number, $this->precision, $this->decimal, ' ');
            } else {
                $number = $number + 0;
                return str_replace('.', $this->decimal, $number);
            }
        } else {
            Alert::warning('Number format incorrect');
            return '';
        }
    }

    public function getMode()
    {
        switch ($this->mode) {
            case 'HALF_UP':
                return PHP_ROUND_HALF_UP;
                break;
            case 'HALF_DOWN':
                return PHP_ROUND_HALF_DOWN;
                break;
            case 'HALF_EVEN':
                return PHP_ROUND_HALF_EVEN;
                break;
            case 'HALF_ODD':
                return PHP_ROUND_HALF_ODD;
                break;
            default:
                return PHP_ROUND_HALF_UP;
                break;
        }
    }
}
