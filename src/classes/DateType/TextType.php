<?php

namespace MyLib\Classes\Formatter;

use MyLib\Classes\Alert;
use MyLib\Interfaces\DataType;

class TextType implements DataType
{
    /**
     * domyślny typ. 
     * Renderuje ciąg znaków, jednak przefiltrowany, tak 
     * żeby nie można było wstawić kodu HTML lub JS.
     */
    public function format(string $value): string
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            Alert::warning('This data type is URL.');
            return '';
        } else {
            return str_replace(' ', '&nbsp;', htmlentities($value));
        }
    }
}
