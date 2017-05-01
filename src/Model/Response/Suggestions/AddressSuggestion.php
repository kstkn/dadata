<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

use Gietos\Dadata\Model\Response\Address;

class AddressSuggestion extends AbstractSuggestion
{
    /**
     * @var Address
     */
    private $data;

    public function getData(): Address
    {
        return $this->data;
    }

    public function setData(Address $data)
    {
        $this->data = $data;
    }
}
