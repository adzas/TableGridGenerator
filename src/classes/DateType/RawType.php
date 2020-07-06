<?php

namespace MyLib\Classes\Formatter;

use MyLib\Interfaces\DataType;

class RawType implements DataType
{
    public function format(string $value): string
    {
        return $value;
    }
}
