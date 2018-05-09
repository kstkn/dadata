<?php

namespace Gietos\Dadata\Model\Response\Version;

use Gietos\Dadata\Model\AbstractModel;

class Version extends AbstractModel
{
    /**
     * @var Dadata
     */
    private $dadata;

    /**
     * @var Suggestions
     */
    private $suggestions;

    /**
     * @var Factor
     */
    private $factor;

    public function getDadata(): Dadata
    {
        return $this->dadata;
    }

    public function setDadata(Dadata $dadata)
    {
        $this->dadata = $dadata;
    }

    public function getSuggestions(): Suggestions
    {
        return $this->suggestions;
    }

    public function setSuggestions(Suggestions $suggestions)
    {
        $this->suggestions = $suggestions;
    }

    public function getFactor(): Factor
    {
        return $this->factor;
    }

    public function setFactor(Factor $factor)
    {
        $this->factor = $factor;
    }
}
