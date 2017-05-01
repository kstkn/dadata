<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

use Gietos\Dadata\Model\Response\Fio;

class FioSuggestion extends AbstractSuggestion
{
    /**
     * @var Fio
     */
    private $data;

    public function getData(): Fio
    {
        return $this->data;
    }

    public function setData(Fio $data)
    {
        $this->data = $data;
    }
}
