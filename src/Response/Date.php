<?php

namespace Dadata\Response;

class Date extends AbstractResponse
{
    /**
     * Исходное значение распознано уверенно
     */
    const QC_OK = 0;

    /**
     * Исходное значение распознано с допущениями или не распознано
     */
    const QC_INVALID = 1;

    /**
     * Исходное значение пустое или заведомо «мусорное»
     */
    const QC_EMPTY = 2;
    
    /**
     * @var string Исходная дата
     */
    public $source;
    
    /**
     * @var string Стандартизованная дата
     */
    public $birthdate;

    public function __toString()
    {
        return (string) $this->birthdate;
    }
}
