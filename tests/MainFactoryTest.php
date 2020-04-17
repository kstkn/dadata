<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\Model\Factory\MainFactory;
use Gietos\Dadata\Tests\Model\ConfigurableModel;
use Gietos\Dadata\Tests\Model\ConfigurableModelChild;

class MainFactoryTest extends BaseTestCase
{
    /**
     * @var MainFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new MainFactory();
    }

    public function scenariosGetCustomFactory()
    {
        return [
            'factory exists' => [\DateTimeImmutable::class, 'Gietos\Dadata\Model\Factory\DateTimeImmutableFactory'],
            'factory does not exist' => [\stdClass::class, ''],
        ];
    }

    /**
     * @dataProvider scenariosGetCustomFactory
     */
    public function testGetCustomFactory(string $className, string $expectedFactoryClassName)
    {
        $class = new \ReflectionClass($className);
        $factoryClassName = $this->invokeMethod($this->factory, 'getCustomFactory', [$class]);
        $this->assertEquals($expectedFactoryClassName, $factoryClassName);
    }

    public function testThrowsExceptionForNull()
    {
        $this->expectException(\TypeError::class);
        $this->factory->createObject(new \ReflectionClass(ConfigurableModel::class), null);
    }

    public function scenariosAttributes()
    {
        return [
            ['{"SomeScalarProperty": 1}', 1, 'someScalarProperty'],
            ['{"SomeArrayProperty": [1,2,3]}', [1, 2, 3], 'someArrayProperty'],
            ['{"SomeDateTime": "2018-01-01"}', new \DateTimeImmutable('2018-01-01'), 'someDateTime'],
        ];
    }

    /**
     * @dataProvider scenariosAttributes
     * @param string $data
     * @param mixed $expectedValue
     * @param string $attributeName
     */
    public function testScalarConfigured(string $data, $expectedValue, string $attributeName)
    {
        $object = $this->factory->createObject(new \ReflectionClass(ConfigurableModel::class), json_decode($data));

        if (is_object($expectedValue)) {
            $this->assertAttributeInstanceOf(get_class($expectedValue), $attributeName, $object);
            $this->assertAttributeEquals($expectedValue, $attributeName, $object);
        } else {
            $this->assertAttributeSame($expectedValue, $attributeName, $object);
        }
    }

    public function testChildConfigured()
    {
        $prototype = json_decode('{"SomeChild": {"SomeChildScalarProperty": "someValue"}}');
        $object = $this->factory->createObject(new \ReflectionClass(ConfigurableModel::class), $prototype);

        $child = $object->getSomeChild();
        $this->assertInstanceOf(ConfigurableModelChild::class, $child);
        /** @var ConfigurableModelChild $child */
        $this->assertEquals('someValue', $child->getSomeChildScalarProperty());
    }
}
