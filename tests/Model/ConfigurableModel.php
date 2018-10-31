<?php

namespace Gietos\Dadata\Tests\Model;

use Gietos\Dadata\Model\AbstractModel;

class ConfigurableModel extends AbstractModel
{
    protected $someScalarProperty;

    protected $someArrayProperty;

    protected $someEnumProperty;

    protected $someChild;

    protected $someDateTime;

    public function unpackSomeArrayProperty(array $someArrayProperty)
    {
        $this->someArrayProperty = $someArrayProperty;
    }

    public function getSomeScalarProperty()
    {
        return $this->someScalarProperty;
    }

    public function getSomeArrayProperty()
    {
        return $this->someArrayProperty;
    }

    public function getSomeChild()
    {
        return $this->someChild;
    }

    public function getSomeDateTime()
    {
        return $this->someDateTime;
    }

    public function unpackSomeChild(ConfigurableModelChild $someChild)
    {
        $this->someChild = $someChild;
    }

    public function unpackSomeDateTime(\DateTimeInterface $dateTime)
    {
        $this->someDateTime = $dateTime;
    }
}
