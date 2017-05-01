<?php

namespace Gietos\Dadata\Model\Response;

use Gietos\Dadata\Model\AbstractModel;

class Balance extends AbstractModel
{
    /**
     * @var float
     */
    private $balance;

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function setBalance(float $balance)
    {
        $this->balance = $balance;
    }
}
