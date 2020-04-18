<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

class FioSuggestionsResponse
{
    /**
     * @var FioSuggestionsCollection
     */
    private $suggestions;

    public function getSuggestions(): FioSuggestionsCollection
    {
        return $this->suggestions;
    }

    public function setSuggestions(FioSuggestionsCollection $suggestions)
    {
        $this->suggestions = $suggestions;
    }
}
