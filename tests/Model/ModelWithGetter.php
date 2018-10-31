<?php

namespace Gietos\Dadata\Tests\Model;

use Gietos\Dadata\Model\AbstractModel;

class ModelWithGetter extends AbstractModel
{
    protected $someProperty;

    public function setSomeProperty($someProperty)
    {
        $this->someProperty = $someProperty;
    }

    public function getSomeProperty()
    {
        return $this->someProperty;
    }
}
