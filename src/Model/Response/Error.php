<?php

namespace Gietos\Dadata\Model\Response;

use Gietos\Dadata\Model\AbstractModel;

class Error extends AbstractModel
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $detail;

    public function __construct(int $code, string $detail)
    {
        $this->code = $code;
        $this->detail = $detail;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getDetail(): string
    {
        return $this->detail;
    }
}
