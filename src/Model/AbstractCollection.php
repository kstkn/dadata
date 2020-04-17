<?php

namespace Gietos\Dadata\Model;

use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractCollection extends ArrayCollection
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
    abstract public function getElementClass(): string;

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
                $this->getElementClass()
            ));
        }

        if (!is_a($element, $this->getElementClass())) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid element (instance of %s) passed to %s, expected: %s',
                get_class($element),
                get_class($this),
                $this->getElementClass()
            ));
        }
    }
}
