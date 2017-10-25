<?php

namespace Gietos\Dadata\Model\Response\Clean;

use Gietos\Dadata\Model\NullableCollection;

class MetroCollection extends NullableCollection
{
    /**
     * @param Metro[] $elements
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
        return Metro::class;
    }
}
