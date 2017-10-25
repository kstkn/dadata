<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

use Gietos\Dadata\Model\AbstractCollection;

class AddressSuggestionsCollection extends AbstractCollection
{
    /**
     * @param AddressSuggestion[] $elements
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
        return AddressSuggestion::class;
    }
}
