<?php

namespace MyLib\Classes;
use MyLib\Interfaces\{Column};

class TableColumn implements Column
{
    protected $type;
    protected $name;

    public function __construct(String $name, String $type = "text") {
        $this->name = $name;
        $this->type = $type;
    }

    public function withLabel(string $label): TableColumn
    {
        $this->name = $label;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->name;
    }

    public function withDataType(DataTypeFormatter $type): TableColumn
    {
        $this->type = $type;
        return $this;
    }

    public function getDataType(): DataTypeFormatter
    {
        return $this->type;
    }

    public function withAlign(string $align): TableColumn
    {
        return $this;
    }

    public function getAlign(): string
    {
        return '';
    }

}
