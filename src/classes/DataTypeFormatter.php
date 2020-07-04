<?php

namespace MyLib\Classes;

use MyLib\Interfaces\DataType;

class DataTypeFormatter implements DataType
{
    public function format(String $value): string
    {
        return '';
    }
}
