<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

class AbstractSuggestion
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $unrestrictedValue;

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function getUnrestrictedValue(): string
    {
        return $this->unrestrictedValue;
    }

    public function setUnrestrictedValue(string $unrestrictedValue)
    {
        $this->unrestrictedValue = $unrestrictedValue;
    }
}
