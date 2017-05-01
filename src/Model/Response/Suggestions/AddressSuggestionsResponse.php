<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

use Gietos\Dadata\Model\AbstractModel;

class AddressSuggestionsResponse extends AbstractModel
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
