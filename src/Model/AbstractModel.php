<?php

namespace Gietos\Dadata\Model;

use Doctrine\Common\Inflector\Inflector;

abstract class AbstractModel implements ConfigurableInterface
{
    public function configure(\stdClass $config): void
    {
        foreach ($config as $key => $value) {
            $propertyName = Inflector::camelize($key);
            $this->setAttribute($propertyName, $value);
        }
    }

    private function isAssoc(array $array): bool
    {
        if ($array === []) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    private function createObject(\ReflectionClass $class, $value)
    {
        $factoryClass = sprintf(__NAMESPACE__ . '\Factory\%sFactory', $class->getShortName());
        if (class_exists($factoryClass)) {
            return call_user_func_array([$factoryClass, 'create'], [$value]);
        }

        if (!$class->implementsInterface(ConfigurableInterface::class)) {
            throw new \LogicException(
                sprintf(
                    'Failed to configure object of class %s, class MUST either implement %s or have a factory %s',
                    $class->getName(),
                    ConfigurableInterface::class,
                    $factoryClass
                )
            );
        }

        $object = $class->newInstanceWithoutConstructor();
        $object->configure($value);

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
     * @param string $name
     * @param mixed $value
     * @throws \InvalidArgumentException
     * @throws \LogicException
     */
    public function setAttribute(string $name, $value): void
    {
        if (method_exists($this, 'unpack' . ucfirst($name))) {
            $methodReflection = new \ReflectionMethod($this, 'unpack' . ucfirst($name));
        } elseif (method_exists($this, 'set' . ucfirst($name))) {
            $methodReflection = new \ReflectionMethod($this, 'set' . ucfirst($name));
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
                    $methodReflection->invokeArgs($this, $this->createObjects($class, ...$value));

                    return;
                } elseif ($value !== null) {
                    $value = $this->createObject($class, $value);
                }
            }
            $methodReflection->invokeArgs($this, [$value]);

            return;
        }

        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
    }
}
