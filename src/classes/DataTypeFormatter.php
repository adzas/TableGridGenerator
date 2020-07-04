<?php

namespace MyLib\Classes;

use MyLib\Interfaces\DataType;

class DataTypeFormatter implements DataType
{
    protected $type = "TextType";
    protected $currency;

    /**
     * ustawia typ danych
     */
    public function setType(String $type)
    {
        $this->type = $type;
        return $this;
    }
    
    /**
     * Powala ustawić walutę
     */
    public function setCurrency(String $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    public function format(String $value): string
    {
        switch ($this->type) {
            case 'TextType':
                $metoda = "domyślny typ. Renderuje ciąg znaków, jednak przefiltrowany, tak żeby nie można było wstawić kodu HTML lub JS.";
                $metoda = $this->textFormating($value);
                break;
            case 'NumberType':
                $metoda = "typ do formatowania wartości liczbowych. Domyślne formatowanie: tysiące oddzielone spacjami, miejsce dziesiętne przecinkiem, dwa miejsca po przecinku zawsze widoczne. Możliwość skonfigurowania: dowolnego separatora (tysięcy i miejsca dziesiętnego), precyzji wyświetlania, metody zaokrąglania, włączenia / wyłączenia stałej ilości miejsc po przecinku.";
                $metoda = $this->numberFormating($value);
                break;
            case 'MoneyType':
                $metoda = "typ do formatowania wartości pieniężnych. Działa podobnie do NumberType, jednak dodatkowo na końcu wyświetla walutę. Możliwość skonfigurowania: dowolnego separatora (tysięcy i miejsca dziesiętnego) oraz wyświetlania miejsc dziesiętnych (można wyłączyć aby nie pokazywać groszy).";
                break;
            case 'DateTimeType':
                $metoda = "formatuje date i czas. Możliwość wybrania formatu (zarówno dayt jak i godziny).";
                break;
            case 'DateType':
                $metoda = "formatuje date. Możliwość wyboru formatowania daty.";
                break;
            case 'ImageType':
                $metoda = "wstawia obrazek w znaczniku img. Domyślnie rozmiar obrazka to 16x16 px. Możliwość zmienienia tego rozmiaru.";
                break;
            case 'LinkType':
                $metoda = "Wstawia link do zasobu. Możliwośc wybrania znacznika a lub button, oraz klasy z Bootstrap 3 w celu zmiany koloru.";
                break;
            case 'RawType':
                $metoda = "Renderuje dokładnie ten sam ciąg znaków co w otrzymanych danych. Służy do wyświetlania HTML. ";
                break;
            default:
                $metoda = "domyślny typ. Renderuje ciąg znaków, jednak przefiltrowany, tak żeby nie można było wstawić kodu HTML lub JS.";
                break;
        }
        return $metoda;
        /*
        TextType - domyślny typ. Renderuje ciąg znaków, jednak przefiltrowany, tak żeby nie można było wstawić kodu HTML lub JS.
        NumberType - typ do formatowania wartości liczbowych. Domyślne formatowanie: tysiące oddzielone spacjami, miejsce dziesiętne przecinkiem, dwa miejsca po przecinku zawsze widoczne. Możliwość skonfigurowania: dowolnego separatora (tysięcy i miejsca dziesiętnego), precyzji wyświetlania, metody zaokrąglania, włączenia / wyłączenia stałej ilości miejsc po przecinku.
        MoneyType - typ do formatowania wartości pieniężnych. Działa podobnie do NumberType, jednak dodatkowo na końcu wyświetla walutę. Możliwość skonfigurowania: dowolnego separatora (tysięcy i miejsca dziesiętnego) oraz wyświetlania miejsc dziesiętnych (można wyłączyć aby nie pokazywać groszy).
        DateTimeType - formatuje date i czas. Możliwość wybrania formatu (zarówno dayt jak i godziny).
        DateType - formatuje date. Możliwość wyboru formatowania daty.
        ImageType - wstawia obrazek w znaczniku img. Domyślnie rozmiar obrazka to 16x16 px. Możliwość zmienienia tego rozmiaru.
        LinkType - Wstawia link do zasobu. Możliwośc wybrania znacznika a lub button, oraz klasy z Bootstrap 3 w celu zmiany koloru.
        RawType - Renderuje dokładnie ten sam ciąg znaków co w otrzymanych danych. Służy do wyświetlania HTML. 
        */
    }

    public function textFormating(string $text)
    {
        return str_replace(' ', '&nbsp;', htmlentities($text));
    }

    public function numberFormating(int $number)
    {
        return number_format($number, 2, '.', ' ');
    }
}
