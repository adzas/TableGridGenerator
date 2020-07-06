<?php

namespace MyLib\Classes\Formatter;

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
        return str_replace(' ', '&nbsp;', htmlentities($value));
    }
}
