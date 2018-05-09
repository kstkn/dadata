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
    protected function getClass(): string
    {
        return Address::class;
    }
}
