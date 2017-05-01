<?php

namespace Gietos\Dadata\Model\Response\Clean;

use Gietos\Dadata\Model\AbstractCollection;

class NameCollection extends AbstractCollection
{
    /**
     * @param Name[] $elements
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
        return Name::class;
    }
}
