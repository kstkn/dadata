<?php

namespace Gietos\Dadata\Model\Response\Version;

class BaseVersionWithResources extends BaseVersion
{
    /**
     * @var array
     */
    protected $resources;

    public function getResources(): array
    {
        return $this->resources;
    }

    public function setResources(array $resources)
    {
        $this->resources = $resources;
    }
}
