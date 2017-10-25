<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

use Gietos\Dadata\Model\AbstractCollection;

class FioSuggestionsCollection extends AbstractCollection
{
    /**
     * @param FioSuggestion[] $elements
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
        return FioSuggestion::class;
    }
}
