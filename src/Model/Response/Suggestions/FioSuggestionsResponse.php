<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

use Gietos\Dadata\Model\AbstractModel;

class FioSuggestionsResponse extends AbstractModel
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
