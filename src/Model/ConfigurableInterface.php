<?php

namespace Gietos\Dadata\Model;

interface ConfigurableInterface
{
    /**
     * @param array $config
     */
    public function configure(array $config = []);
}
