<?php

namespace Dadata\Response;

class Passport extends AbstractResponse
{
    /**
     * Действующий паспорт
     */
    const QC_OK = 0;

    /**
     * Неправильный формат серии или номера
     */
    const QC_WRONG_FORMAT = 1;

    /**
     * Исходное значение пустое
     */
    const QC_EMPTY_SOURCE = 2;

    /**
     * Недействительный паспорт
     */
    const QC_INVALID = 10;
    
    /**
     * @var string Исходная серия и номер одной строкой
     */
    public $source;
    
    /**
     * @var string Серия
     */
    public $series;
    
    /**
     * @var string Номер
     */
    public $number;

    public function __toString()
    {
        return implode(' ', [$this->series, $this->number]);
    }
}
