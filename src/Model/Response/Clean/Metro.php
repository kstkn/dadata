<?php

namespace Gietos\Dadata\Model\Response\Clean;

use Gietos\Dadata\Model\AbstractModel;

class Metro extends AbstractModel
{
    /**
     * @var float
     */
    private $distance;

    /**
     * @var string
     */
    private $line;

    /**
     * @var string
     */
    private $name;

    public function getDistance(): float
    {
        return $this->distance;
    }

    public function setDistance(float $distance)
    {
        $this->distance = $distance;
    }

    public function getLine(): string
    {
        return $this->line;
    }

    public function setLine(string $line)
    {
        $this->line = $line;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}
