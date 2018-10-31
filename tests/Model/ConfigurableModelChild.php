<?php

namespace Gietos\Dadata\Tests\Model;

use Gietos\Dadata\Model\AbstractModel;

class ConfigurableModelChild extends AbstractModel
{
    protected $someChildScalarProperty;

    public function getSomeChildScalarProperty()
    {
        return $this->someChildScalarProperty;
    }
}
