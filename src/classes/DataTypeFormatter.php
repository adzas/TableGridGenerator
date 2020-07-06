<?php

namespace MyLib\Classes;

use MyLib\Interfaces\DataType;
use MyLib\Classes\Formatter\DateTimeType;
use MyLib\Classes\Formatter\DateType;
use MyLib\Classes\Formatter\ImageType;
use MyLib\Classes\Formatter\LinkType;
use MyLib\Classes\Formatter\MoneyType;
use MyLib\Classes\Formatter\NumberType;
use MyLib\Classes\Formatter\RawType;
use MyLib\Classes\Formatter\TextType;

class DataTypeFormatter implements DataType
{
    protected $dataTypeSettings = [];
    protected $dataTimeTypeSettings = [];
    protected $imageTypeSettings = [];
    protected $linkTypeSettings = [];
    protected $moneyTypeSettings = [];
    protected $numberTypeSettings = [];
    protected $rawTypeSettings = [];
    protected $type = "TextType";

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
    public function setDecimal(string $dec): DataTypeFormatter
    {
        $this->numberTypeSettings['decimal'] = $dec;
        return $this;
    }

    public function setPrecision(int $precision)
    {
        $this->numberTypeSettings['precision'] = $precision;
        return $this;
    }

    /**
     * funkcje zapisujące ustawienia dla zmiennych typu walutowego
     */
    public function setSeparator(string $separator): DataTypeFormatter
    {
        $this->moneyTypeSettings['separator'] = $separator;
        return $this;
    }

    public function setPrecisionMoney(int $precision)
    {
        $this->moneyTypeSettings['precision'] = $precision;
        return $this;
    }

    public function setCurrency(string $currency)
    {
        $this->moneyTypeSettings['currency'] = $currency;
        return $this;
    }
    
    public function setWithoutDecimalPlaces(bool $setWithoutDecimalPlaces)
    {
        $this->moneyTypeSettings['withoutDecimalPlaces'] = $setWithoutDecimalPlaces;
        return $this;
    }

    public function setMode(string $mode)
    {
        $this->numberTypeSettings['mode'] = $mode;
        return $this;
    }

    public function setConstDecimalPlacesAway(bool $constDecimalPlacesAway)
    {
        $this->numberTypeSettings['constDecimalPlacesAway'] = $constDecimalPlacesAway;
        return $this;
    }

    /**
     * funkcje zapisujące ustawienia dla zmiennych typu data
     */
    public function setDateFormat(string $dateFormat): DataTypeFormatter
    {
        $this->dataTypeSettings['dateFormat'] = $dateFormat;
        return $this;
    }

    /**
     * funkcje zapisujące ustawienia dla zmiennych typu data - czas
     */
    public function setDateTimeFormat(string $dateTimeFormat): DataTypeFormatter
    {
        $this->dataTimeTypeSettings['dateTimeFormat'] = $dateTimeFormat;
        return $this;
    }

    /**
     * funkcje zapisujące ustawienia dla zmiennych typu zdjęcie
     */
    public function setWidthImage(string $widthImage): DataTypeFormatter
    {
        $this->imageTypeSettings['widthImage'] = $widthImage;
        return $this;
    }

    public function setHeightImage(string $heightImage): DataTypeFormatter
    {
        $this->imageTypeSettings['heightImage'] = $heightImage;
        return $this;
    }

    /**
     * funkcje zapisujące ustawienia dla zmiennych typu link
     */
    public function setTypeLink(string $typeLink): DataTypeFormatter
    {
        $this->linkTypeSettings['typeLink'] = $typeLink;
        return $this;
    }

    public function setClassLink(string $classLink): DataTypeFormatter
    {
        $this->linkTypeSettings['classLink'] = $classLink;
        return $this;
    }

    public function format(String $value): string
    {
        switch ($this->type) {
            case 'DateTimeType':
                $return = (new DateTimeType($this->dataTimeTypeSettings))->format($value);
                break;
            case 'DateType':
                $return = (new DateType($this->dataTypeSettings))->format($value);
                break;
            case 'MoneyType':
                $return = (new MoneyType($this->moneyTypeSettings))->format($value);
                break;
            case 'ImageType':
                $return = (new ImageType($this->imageTypeSettings))->format($value);
                break;
            case 'LinkType':
                $return = (new LinkType($this->linkTypeSettings))->format($value);
                break;
            case 'NumberType':
                $return = (new NumberType($this->numberTypeSettings))->format($value);
                break;
            case 'RawType':
                $return = (new RawType($this->rawTypeSettings))->format($value);
                break;
            case 'TextType':
                $return = (new TextType())->format($value);
                break;
            default:
                $return = (new TextType())->format($value);
                break;
        }
        return $return;
    }

    public function NumberTypeFormat(float $number)
    {
        return number_format($number, 2, ',', ' ');
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
