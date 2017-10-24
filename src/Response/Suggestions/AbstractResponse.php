<?php

namespace Dadata\Response\Suggestions;

abstract class AbstractResponse
{
    protected $rawResponse;

    public function getRawResponse()
    {
        return $this->rawResponse;
    }
}
