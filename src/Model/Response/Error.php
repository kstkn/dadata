<?php

namespace Gietos\Dadata\Model\Response;

class Error
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
