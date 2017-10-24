<?php

namespace Dadata\Response\Suggestions\Party;

class NameDto
{
    /**
     * @var string Полное наименование с ОПФ
     */
    private $fullWithOpf;
    /**
     * @var string Краткое наименование с ОПФ
     */
    private $shortWithOpf;
    /**
     * @var string Наименование на латинице
     */
    private $latin;
    /**
     * @var string Полное наименование
     */
    private $full;
    /**
     * @var string Краткое наименование
     */
    private $short;

    public function __construct(
        $fullWithOpf,
        $shortWithOpf,
        $latin,
        $full,
        $short
    ) {
        $this->fullWithOpf = $fullWithOpf;
        $this->shortWithOpf = $shortWithOpf;
        $this->latin = $latin;
        $this->full = $full;
        $this->short = $short;
    }

    /**
     * @return string
     */
    public function getFullWithOpf()
    {
        return $this->fullWithOpf;
    }

    /**
     * @return string
     */
    public function getShortWithOpf()
    {
        return $this->shortWithOpf;
    }

    /**
     * @return string
     */
    public function getLatin()
    {
        return $this->latin;
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