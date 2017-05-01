<?php

namespace Gietos\Dadata\Model\Response\Version;

use Gietos\Dadata\Model\AbstractModel;

abstract class BaseVersion extends AbstractModel
{
    /**
     * @var string
     */
    protected $version;

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version)
    {
        $this->version = $version;
    }
}
