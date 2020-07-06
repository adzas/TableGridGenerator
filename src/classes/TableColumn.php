<?php

namespace MyLib\Classes;
use MyLib\Interfaces\{Column};

class TableColumn implements Column
{
    protected $align;
    protected $name;
    protected $type;

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
        $this->align = $align;
        return $this;
    }

    public function getAlign(): string
    {
        return $this->align;
    }

}
