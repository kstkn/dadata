<?php

namespace Dadata\Response;

class Phone extends AbstractResponse
{
    /**
     * Телефон распознан уверенно
     */
    const QC_OK = 0;

    /**
     * Телефон пустой или заведомо «мусорный»
     */
    const QC_EMPTY = 2;

    /**
     * Телефон распознан с допущениями или не распознан
     */
    const QC_INVALID = 1;

    /**
     * Обнаружено несколько телефонов, распознан первый
     */
    const QC_MULTIPLE = 3;

    /**
     * Телефон соответствует адресу
     */
    const QC_CONFLICT_OK = 0;

    /**
     * Города адреса и телефона отличаются
     */
    const QC_CITY_MISMATCH = 2;

    /**
     * Регионы адреса и телефона отличаются
     */
    const QC_REGION_MISMATCH = 3;

    /**
     * @var string Исходный телефон одной строкой
     */
    public $source;

    /**
     * @var string Тип телефона
     */
    public $type;

    /**
     * @var string Стандартизованный телефон одной строкой
     */
    public $phone;

    /**
     * @var integer Код страны
     */
    public $country_code;

    /**
     * @var integer Код города / DEF-код
     */
    public $city_code;

    /**
     * @var string Локальный номер телефона
     */
    public $number;

    /**
     * @var string Добавочный номер
     */
    public $extension;

    /**
     * @var string Оператор связи
     */
    public $provider;

    /**
     * @var string Регион
     */
    public $region;

    /**
     * @var string Часовой пояс
     */
    public $timezone;

    /**
     * @var integer Признак конфликта телефона с адресом (see QC_CONFLICT_* constants)
     */
    public $qc_conflict;

    public function __toString()
    {
        return (string) $this->phone;
    }
}
