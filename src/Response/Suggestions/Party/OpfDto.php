<?php

namespace Dadata\Response\Suggestions\Party;

class OpfDto
{
    /**
     * @var string Версия справочника ОКОПФ (99, 2012 или 2014)
     */
    private $type;
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
        $type,
        $code,
        $full,
        $short
    ) {
        $this->type = $type;
        $this->code = $code;
        $this->full = $full;
        $this->short = $short;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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