<?php

namespace MyLib\Classes;

use MyLib\Interfaces\DataType;
use MyLib\Classes\Formatter\NumberType;

class DataTypeFormatter implements DataType
{
    protected $type = "TextType";
    protected $numberSet = [];

    /**
     * ustawia typ danych
     */
    public function setType(String $type): DataTypeFormatter
    {
        $this->type = $type;
        return $this;
    }

    /**
     * funkcje zapisujące ustawienia dla zmiennych typu number
     */
    public function setDec(string $dec): DataTypeFormatter
    {
        $this->numberSet['dec'] = $dec;
        return $this;
    }

    public function setPrecision(int $precision)
    {
        $this->numberSet['precision'] = $precision;
        return $this;
    }

    public function setMode(string $mode)
    {
        /**
         * PHP_ROUND_HALF_UP
         * PHP_ROUND_HALF_DOWN
         * PHP_ROUND_HALF_EVEN
         * PHP_ROUND_HALF_ODD
         */
        $this->numberSet['mode'] = $mode;
        return $this;
    }

    public function setConstDecimalPlacesAway(bool $constDecimalPlacesAway)
    {
        $this->numberSet['constDecimalPlacesAway'] = $constDecimalPlacesAway;
        return $this;
    }

    /**
     * funkcje zapisujące ustawienia dla zmiennych typu waluta
     */


    public function format(String $value): string
    {
        switch ($this->type) {
            case 'TextType':
                $return = $this->TextTypeFormat($value);
                break;
            case 'NumberType':
                $numberType = new NumberType($this->numberSet);
                $return = $numberType->format($value);
                break;
            case 'MoneyType':
                $return = $this->MoneyTypeFormat($value);
                break;
            case 'DateTimeType':
                $return = $this->DateTimeTypeFormat($value);
                break;
            case 'DateType':
                $return = $this->DateTypeFormat($value);
                break;
            case 'ImageType':
                $return = $this->ImageTypeFormat($value);
                break;
            case 'LinkType':
                $return = $this->LinkTypeFormat($value);
                break;
            case 'RawType':
                $return = $this->RawTypeFormat($value);
                break;
            default:
                $return = "domyślny typ. Renderuje ciąg znaków, jednak przefiltrowany, tak żeby nie można było wstawić kodu HTML lub JS.";
                break;
        }
        return $return;
    }

    /**
     * domyślny typ. 
     * Renderuje ciąg znaków, jednak przefiltrowany, tak 
     * żeby nie można było wstawić kodu HTML lub JS.
     */
    public function TextTypeFormat(string $text)
    {
        return str_replace(' ', '&nbsp;', htmlentities($text));
    }

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
    public function NumberTypeFormat(float $number)
    {
        return number_format($number, 2, ',', ' ');
    }


    /**
     * Money Type - typ do formatowania wartości pieniężnych. 
     * Działa podobnie do NumberType, 
     * jednak dodatkowo na końcu wyświetla walutę. 
     * Możliwość skonfigurowania: 
     * dowolnego separatora (tysięcy i miejsca dziesiętnego)
     * oraz wyświetlania miejsc dziesiętnych (można wyłączyć aby nie pokazywać groszy).
     */
    public function MoneyTypeFormat(float $value)
    {
        return 'error';
    }

    /**
     * DateType - formatuje date. 
     * Możliwość wyboru formatowania daty.
     */
    public function DateTypeFormat(String $date)
    {
        return 'error';
    }

    /**
     * DateTimeType - formatuje date i czas. 
     * Możliwość wybrania formatu (zarówno dayt jak i godziny).
     */
    public function DateTimeTypeFormat(String $date)
    {
        return 'error';
    }

    /**
     * ImageType - wstawia obrazek w znaczniku img.
     * Domyślnie rozmiar obrazka to 16x16 px.
     * Możliwość zmienienia tego rozmiaru.
     */
    public function ImageTypeFormat(String $src)
    {
        return 'error';
    }

    /**
     * LinkType - Wstawia link do zasobu. 
     * Możliwośc wybrania znacznika a lub button, 
     * oraz klasy z Bootstrap 3 w celu zmiany koloru.
     */
    public function LinkTypeFormat(String $link)
    {
        return 'error';
    }

    /**
     * RawType - Renderuje dokładnie ten sam ciąg znaków co w otrzymanych danych. 
     * Służy do wyświetlania HTML. 
     */
    public function RawTypeFormat($value)
    {
        return $value;
    }

}
