<?php

namespace Gietos\Dadata\Model;

use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractCollection extends ArrayCollection implements ConfigurableInterface
{
    public function __construct(array $elements = [])
    {
        foreach ($elements as $element) {
            $this->validateElement($element);
        }
        parent::__construct($elements);
    }

    /**
     * Declares which elements can this collection contain.
     */
    abstract protected function getClass(): string;

    /**
     * Checks if element collection constructed with has correct class.
     *
     * @param object $element
     */
    public function validateElement($element)
    {
        if (!is_object($element)) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid element of type %s passed to %s, expected: %s',
                gettype($element),
                get_class($this),
                $this->getClass()
            ));
        }

        if (!is_a($element, $this->getClass())) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid element (instance of %s) passed to %s, expected: %s',
                get_class($element),
                get_class($this),
                $this->getClass()
            ));
        }
    }

    /**
     * @param array $config
     */
    public function configure(array $config = [])
    {
        $className = $this->getClass();
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
