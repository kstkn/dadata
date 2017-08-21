<?php

namespace Dadata\Response\Suggestions\Party;

class OpfDto
{
    /**
     * @var string Код ОКОПФ
     */
    private $code;
    /**
     * @var string Полное название ОПФ
     */
    private $full;
    /**
     * @var string Краткое название ОПФ
     */
    private $short;

    public function __construct(
        $code,
        $full,
        $short
    ) {
        $this->code = $code;
        $this->full = $full;
        $this->short = $short;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     * @return string
     */
    public function getShort()
    {
        return $this->short;
    }
}