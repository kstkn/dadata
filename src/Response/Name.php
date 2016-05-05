<?php

namespace Dadata\Response;

class Name extends AbstractResponse
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
     * @var string ФИО в родительном падеже (кого?)
     */
    public $result_genitive;
    
    /**
     * @var string ФИО в дательном падеже (кому?)
     */
    public $result_dative;
    
    /**
     * @var string ФИО в творительном падеже (кем?)
     */
    public $result_ablative;
    
    /**
     * @var string Фамилия
     */
    public $surname;
    
    /**
     * @var string Имя
     */
    public $name;
    
    /**
     * @var string Отчество
     */
    public $patronymic;
    
    /**
     * @var string Пол
     *             М — мужской;
     *             Ж — женский;
     *             НД — не удалось однозначно определить.
     */
    public $gender;
}
