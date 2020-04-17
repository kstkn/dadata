<?php

namespace Gietos\Dadata\Tests\Model;

class ConfigurableModelChild
{
    protected $someChildScalarProperty;

    public function getSomeChildScalarProperty()
    {
        return $this->someChildScalarProperty;
    }
}
