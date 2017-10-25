<?php

namespace Gietos\Dadata\Model\Response\Version;

use Gietos\Dadata\Model\AbstractModel;

class Dadata extends AbstractModel
{
    /**
     * @var string
     */
    private $version;

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version)
    {
        $this->version = $version;
    }
}
