<?php

namespace Gietos\Dadata\Model\Response\Suggestions;

use Gietos\Dadata\Model\AbstractModel;

class Email extends AbstractModel
{
    /**
     * @var string
     */
    protected $local;

    /**
     * @var string
     */
    protected $domain;

    public function getLocal(): string
    {
        return $this->local;
    }

    public function setLocal(string $local)
    {
        $this->local = $local;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function setDomain(string $domain)
    {
        $this->domain = $domain;
    }
}
