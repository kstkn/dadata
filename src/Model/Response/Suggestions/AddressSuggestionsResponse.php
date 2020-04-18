<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

class AddressSuggestionsResponse
{
    /**
     * @var AddressSuggestionsCollection
     */
    private $suggestions;

    public function getSuggestions(): AddressSuggestionsCollection
    {
        return $this->suggestions;
    }

    public function setSuggestions(AddressSuggestionsCollection $suggestions)
    {
        $this->suggestions = $suggestions;
    }
}
