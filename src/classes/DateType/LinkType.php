<?php

namespace MyLib\Classes\Formatter;

use MyLib\Interfaces\DataType;

class LinkType implements DataType
{
    /**
     * LinkType - Wstawia link do zasobu. 
     * Możliwośc wybrania znacznika a lub button, 
     * oraz klasy z Bootstrap 3 w celu zmiany koloru.
     */
    protected $classLink;
    protected $typeLink;

    public function __construct(array $sets = null) {
        $this->typeLink = $sets['typeLink'];
        $this->classLink = $sets['classLink'];
    }

    public function format(string $value): string
    {
        if ($this->typeLink == 'button') {
            return $this->renderButtonLink($value);
        } else {
            return $this->renderLink($value);
        }
    }

    public function renderLink(string $value)
    {
        return '<a href="' . $value . '">link</a>';
    }

    public function renderButtonLink(string $value)
    {
        return '
        <form action="' . $value . '" method="GET">
            <button class="btn ' . $this->classLink . '">link</button>
        </form>';
    }
}
