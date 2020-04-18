<?php

namespace Gietos\Dadata\Model\Response\Version;

abstract class BaseVersion
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
