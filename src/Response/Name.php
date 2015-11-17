<?php

namespace Dadata\Response;

class Name extends Base
{
    /**
     * @var string Исходные ФИО одной строкой
     */
    public $source;
    /**
     * @var string Стандартизованные ФИО одной строкой
     */
    public $result;
    /**
     * @var string Фамилия
     */
    public $surname;
    /**
     * @var string Имя
     */
    public $name;
    /**
     * @var string Пол
     *             М — мужской;
     *             Ж — женский;
     *             НД — не удалось однозначно определить.
     */
    public $gender;

}
