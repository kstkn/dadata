<?php

namespace Gietos\Dadata\Model\Response;

class Balance
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
