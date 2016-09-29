<?php

namespace Dadata\Response;

class Name extends AbstractResponse
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
     * Пол мужской
     */
    const GENDER_MALE = 'М';

    /**
     * Пол женский
     */
    const GENDER_FEMALE = 'Ж';

    /**
     * Пол не удалось однозначно определить
     */
    const GENDER_UNKNOWN = 'НД';

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
     * @var string Пол (see GENDER_* constants)
     */
    public $gender;

    public function __toString()
    {
        return (string) $this->result;
    }
}
