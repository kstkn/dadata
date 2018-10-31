<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\Tests\Model\ConfigurableModel;
use Gietos\Dadata\Tests\Model\ConfigurableModelChild;

class ConfigureTest extends BaseTestCase
{
    public function dataProvider()
    {
        return [
            ['{"SomeScalarProperty": 1}', 1, 'someScalarProperty'],
            ['{"SomeArrayProperty": [1,2,3]}', [1, 2, 3], 'someArrayProperty'],
            ['{"SomeDateTime": "2018-01-01"}', new \DateTimeImmutable('2018-01-01'), 'someDateTime'],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param string $data
     * @param mixed $expectedValue
     * @param string $attributeName
     */
    public function testScalarConfigured($data, $expectedValue, $attributeName)
    {
        $object = new ConfigurableModel;
        $data = json_decode($data);
        $object->configure($data);

        if (is_object($expectedValue)) {
            $this->assertAttributeInstanceOf(get_class($expectedValue), $attributeName, $object);
            $this->assertAttributeEquals($expectedValue, $attributeName, $object);
        } else {
            $this->assertAttributeSame($expectedValue, $attributeName, $object);
        }
    }

    public function testChildConfigured()
    {
        $object = new ConfigurableModel();
        $object->configure(json_decode('{"SomeChild": {"SomeChildScalarProperty": "someValue"}}'));

        $child = $object->getSomeChild();
        $this->assertInstanceOf(ConfigurableModelChild::class, $child);
        /** @var ConfigurableModelChild $child */
        $this->assertEquals('someValue', $child->getSomeChildScalarProperty());
    }
}
