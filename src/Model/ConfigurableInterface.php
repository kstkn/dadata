<?php

namespace Gietos\Dadata\Model;

interface ConfigurableInterface
{
    public function configure(\stdClass $config): void;
}
