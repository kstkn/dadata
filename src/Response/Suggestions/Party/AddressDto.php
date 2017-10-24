<?php

namespace Dadata\Response\Suggestions\Party;

class AddressDto
{
    private $value;
    private $unrestrictedValue;

    public function __construct(
        $value,
        $unrestrictedValue
    ) {
        $this->value = $value;
        $this->unrestrictedValue = $unrestrictedValue;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnrestrictedValue()
    {
        return $this->unrestrictedValue;
    }
}