<?php

namespace Dadata\Response;

class Vehicle extends AbstractResponse
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
     * @var string Стандартизованное значение
     */
    public $result;

    /**
     * @var string Марка
     */
    public $brand;

    /**
     * @var string Модель
     */
    public $model;

    public function __toString()
    {
        return (string) $this->result;
    }
}
