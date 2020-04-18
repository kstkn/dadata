<?php

namespace Gietos\Dadata\Model\Factory;

use Doctrine\Common\Inflector\Inflector;
use Gietos\Dadata\Model\AbstractCollection;
use Gietos\Dadata\Model\NullableCollection;

class MainFactory
{
    /**
     * @param mixed $prototype
     * @return object
     */
    public function createObject(\ReflectionClass $class, $prototype)
    {
        if ($factoryClass = $this->getCustomFactory($class)) {
            return call_user_func_array([$factoryClass, 'create'], [$prototype]);
        }

        if (!$prototype instanceof \stdClass) {
            throw new \TypeError(sprintf(
                'Received unexpected value of type %s as a prototype for class %s. Instance of \stdClass expected',
                gettype($prototype),
                $class->getName()
            ));
        }

        $object = $class->newInstanceWithoutConstructor();
        foreach ($prototype as $key => $value) {
            $propertyName = Inflector::camelize($key);
            $this->setAttribute($object, $propertyName, $value);
        }

        return $object;
    }

    private function createObjects(\ReflectionClass $class, ...$values): array
    {
        foreach ($values as $i => $value) {
            $values[$i] = $this->createObject($class, $value);
        }

        return $values;
    }

    /**
     * @return AbstractCollection
     */
    public function createCollection(\ReflectionClass $class, ?array $elements)
    {
        /** @var AbstractCollection $collection */
        $collection = $class->newInstance();

        if ($collection instanceof NullableCollection && $elements === null) {
            return $collection;
        }

        $itemClass = new \ReflectionClass($collection->getElementClass());
        foreach ($elements as $elementPrototype) {
            $collection->add(self::createObject($itemClass, $elementPrototype));
        }
        return $collection;
    }

    private function isAssoc(array $array): bool
    {
        if ($array === []) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    private function getCustomFactory(\ReflectionClass $class): string
    {
        $factoryClass = sprintf(__NAMESPACE__ . '\%sFactory', $class->getShortName());
        return class_exists($factoryClass) ? $factoryClass : '';
    }

    /**
     * @param object $object
     * @param string $name
     * @param mixed $value
     */
    public function setAttribute($object, string $name, $value): void
    {
        if (method_exists($object, 'unpack' . ucfirst($name))) {
            $methodReflection = new \ReflectionMethod($object, 'unpack' . ucfirst($name));
        } elseif (method_exists($object, 'set' . ucfirst($name))) {
            $methodReflection = new \ReflectionMethod($object, 'set' . ucfirst($name));
        }

        if (isset($methodReflection)) {
            $params = $methodReflection->getParameters();
            if (count($params) !== 1) {
                throw new \InvalidArgumentException(sprintf(
                    'Only methods with exactly 1 argument is supported. Unsupported method: %s',
                    $methodReflection->getName()
                ));
            }

            $param = $params[0];
            if ($class = $param->getClass()) {
                if (is_array($value) && !$this->isAssoc($value)) {
                    $methodReflection->invokeArgs($object, $this->createObjects($class, ...$value));

                    return;
                } elseif ($value !== null) {
                    $value = $this->createObject($class, $value);
                }
            }
            $methodReflection->invokeArgs($object, [$value]);

            return;
        }

        if (property_exists($object, $name)) {
            $property = new \ReflectionProperty($object, $name);
            $property->setAccessible(true);
            $property->setValue($object, $value);
        }
    }
}
