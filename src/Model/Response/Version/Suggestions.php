<?php

namespace Gietos\Dadata\Model\Response\Version;

use Gietos\Dadata\Model\AbstractModel;

class Suggestions extends AbstractModel
{
    /**
     * @var string
     */
    private $version;

    /**
     * @var array
     */
    private $resources;

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version)
    {
        $this->version = $version;
    }

    public function getResources(): array
    {
        return $this->resources;
    }

    public function setResources(array $resources)
    {
        $this->resources = $resources;
    }
}
