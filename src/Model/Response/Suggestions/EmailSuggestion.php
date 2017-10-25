<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

class EmailSuggestion extends AbstractSuggestion
{
    /**
     * @var Email
     */
    private $data;

    public function getData(): Email
    {
        return $this->data;
    }

    public function setData(Email $data)
    {
        $this->data = $data;
    }
}
