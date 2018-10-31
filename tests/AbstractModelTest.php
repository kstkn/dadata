<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\Model\AbstractModel;

class DummyConfigurableChildModel extends AbstractModel
{
    protected $someChildScalarProperty;

    public function getSomeChildScalarProperty()
    {
        return $this->someChildScalarProperty;
    }
}

class DummyConfigurableModel extends AbstractModel
{
    protected $someScalarProperty;

    protected $someArrayProperty;

    protected $someChild;

    public function setSomeArrayProperty(array $someArrayProperty)
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

    public function setSomeChild(DummyConfigurableChildModel $someChild)
    {
        $this->someChild = $someChild;
    }
}

class ConfigureTest extends BaseTestCase
{
    public function testScalarConfigured()
    {
        $object = new DummyConfigurableModel;
        $object->configure(['SomeScalarProperty' => 1]);

        $this->assertEquals(1, $object->getSomeScalarProperty());
    }

    public function testArrayConfigured()
    {
        $object = new DummyConfigurableModel;
        $object->configure(['SomeArrayProperty' => [1, 2, 3]]);

        $this->assertEquals([1, 2, 3], $object->getSomeArrayProperty());
    }

    public function testChildConfigured()
    {
        $object = new DummyConfigurableModel();
        $object->configure(['SomeChild' => [
            'SomeChildScalarProperty' => 'someValue',
        ]]);

        $child = $object->getSomeChild();
        $this->assertInstanceOf(DummyConfigurableChildModel::class, $child);
        /** @var DummyConfigurableChildModel $child */
        $this->assertEquals('someValue', $child->getSomeChildScalarProperty());
    }
}
