<?php

namespace Dadata\Response;

class Phone extends AbstractResponse
{
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
     * @var integer|null Код страны
     */
    public $country_code;

    /**
     * @var integer|null Код города / DEF-код
     */
    public $city_code;

    /**
     * @var integer|null Локальный номер телефона
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
     * @var integer Признак конфликта телефона с адресом
     *              0	Телефон соответствует адресу
     *              2	Города адреса и телефона отличаются
     *              3	Регионы адреса и телефона отличаются
     */
    public $qc_conflict;
}
