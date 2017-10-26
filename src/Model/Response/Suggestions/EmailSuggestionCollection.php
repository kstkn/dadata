<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

use Gietos\Dadata\Model\AbstractCollection;

class EmailSuggestionCollection extends AbstractCollection
{
    /**
     * @param EmailSuggestion[] $elements
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
        return EmailSuggestion::class;
    }
}
