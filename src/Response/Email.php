<?php

namespace Dadata\Response;

class Email extends AbstractResponse
{
    /**
     * Корректное значение
     * Соответствует общепринятым правилам,
     * реальное существование адреса не проверяется
     */
    const QC_OK = 0;

    /**
     * Некорректное значение
     * Не соответствует общепринятым правилам
     */
    const QC_INVALID = 1;

    /**
     * Пустое или заведомо «мусорное» значение
     */
    const QC_EMPTY = 2;

    /**
     * «Одноразовый» адрес
     * Домены 10minutemail.com, getairmail.com, temp-mail.ru и аналогичные
     */
    const QC_DISPOSABLE = 3;

    /**
     * Исправлены опечатки
     */
    const QC_CORRECTED = 4;
    
    /**
     * @var string Исходный email
     */
    public $source;
    
    /**
     * @var string Стандартизованный email
     */
    public $email;

    public function __toString()
    {
        return (string) $this->email;
    }
}
