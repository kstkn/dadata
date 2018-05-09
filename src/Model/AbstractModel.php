<?php

namespace Gietos\Dadata\Model;

use Doctrine\Common\Inflector\Inflector;

abstract class AbstractModel implements ConfigurableInterface
{
    /**
     * @param array $config
     */
    public function configure(array $config = [])
    {
        foreach ($config as $key => $value) {
            $propertyName = Inflector::camelize($key);
            $this->setProperty($propertyName, $value);
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setProperty(string $name, $value)
    {
        $setter = 'set' . ucfirst($name);

        if (method_exists($this, $setter)) {
            $methodReflection = new \ReflectionMethod($this, $setter);
            $params = $methodReflection->getParameters();
            if (count($params) !== 1) {
                throw new \LogicException(
                    sprintf('Setter method %s::%s must have exactly 1 argument', get_class($this), $setter)
                );
            }
            $param = $params[0];
            if (null === $value) {
                if (false === $param->allowsNull()) {
                    throw new \LogicException(
                        sprintf('Setter method %s::%s doesn\'t allow null', get_class($this), $setter)
                    );
                }
            } else {
                if ($class = $param->getClass()) {
                    $object = $class->newInstance();
                    if ($object instanceof ConfigurableInterface) {
                        $object->configure($value);
                        $value = $object;
                    }
                }
            }

            call_user_func([$this, $setter], $value);

            return;
        }

        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
    }
}
