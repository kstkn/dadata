<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\Model\AbstractModel;
use Gietos\Dadata\Tests\Model\ModelWithPublicProperty;

class AbstractModelTest extends BaseTestCase
{
    public function scenariosGetFactory()
    {
        return [
            'factory exists' => [\DateTimeImmutable::class, 'Gietos\Dadata\Model\Factory\DateTimeImmutableFactory'],
            'factory does not exist' => [\stdClass::class, ''],
        ];
    }

    /**
     * @dataProvider scenariosGetFactory
     */
    public function testGetFactory(string $className, string $expectedFactoryClassName)
    {
        $mock = $this->getMockForAbstractClass(AbstractModel::class);
        $class = new \ReflectionClass($className);
        $factoryClassName = $this->invokeMethod($mock, 'getFactory', [$class]);
        $this->assertEquals($expectedFactoryClassName, $factoryClassName);
    }

    public function testThrowsExceptionForNull()
    {
        $this->expectException(\TypeError::class);
        $dummy = new ModelWithPublicProperty();
        $dummy->configure(null);
    }
}
