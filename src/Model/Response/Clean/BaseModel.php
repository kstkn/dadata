<?php

namespace Gietos\Dadata\Model\Response\Clean;

trait BaseModel
{
    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $result;

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source)
    {
        $this->source = $source;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function setResult(string $result)
    {
        $this->result = $result;
    }
}
