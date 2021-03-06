<?php

namespace MyLib\Classes\Formatter;

use MyLib\Classes\Alert;
use MyLib\Interfaces\DataType;

class ImageType implements DataType
{
    /**
     * ImageType - wstawia obrazek w znaczniku img.
     * Domyślnie rozmiar obrazka to 16x16 px.
     * Możliwość zmienienia tego rozmiaru.
     */
    protected $heightImage;
    protected $widthImage;

    public function __construct(array $sets = null) {
        $this->widthImage = $sets['widthImage'];
        $this->heightImage = $sets['heightImage'];
    }

    public function format(string $value): string
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            $style = 'width: ' . $this->widthImage . '; height: ' . $this->heightImage . '';
            return '<img style="' . $style . '" src="' . htmlentities($value) . '"/>';
        } else {
            Alert::warning('URL type is incorrect');
            return '';
        }
    }
}
