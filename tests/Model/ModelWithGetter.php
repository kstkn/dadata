<?php

namespace Gietos\Dadata\Tests\Model;

class ModelWithGetter
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
