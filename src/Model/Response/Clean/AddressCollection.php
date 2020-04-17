<?php

namespace Gietos\Dadata\Model\Response\Clean;

use Gietos\Dadata\Model\AbstractCollection;

class AddressCollection extends AbstractCollection
{
    /**
     * @param Address[] $elements
     */
    public function __construct(array $elements = [])
    {
        parent::__construct($elements);
    }

    /**
     * @inheritdoc
     */
    public function getElementClass(): string
    {
        return Address::class;
    }
}
