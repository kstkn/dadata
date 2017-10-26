<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

use Gietos\Dadata\Model\AbstractModel;

class EmailSuggestionResponse extends AbstractModel
{
    /**
     * @var EmailSuggestionCollection
     */
    private $suggestions;

    public function getSuggestions(): EmailSuggestionCollection
    {
        return $this->suggestions;
    }

    public function setSuggestions(EmailSuggestionCollection $suggestions)
    {
        $this->suggestions = $suggestions;
    }
}
