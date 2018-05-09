<?php

namespace Gietos\Dadata\Model;

abstract class NullableCollection extends AbstractCollection
{
    /**
     * @param array $config
     */
    public function configure(?array $config = [])
    {
        $className = $this->getClass();
        if (is_null($config)) {
            return;
        }
        foreach ($config as $item) {
            $reflection = new \ReflectionClass($className);
            $object = $reflection->newInstanceWithoutConstructor();
            if ($object instanceof ConfigurableInterface) {
                $object->configure($item);
            }
            $this->add($object);
        }
    }
}
