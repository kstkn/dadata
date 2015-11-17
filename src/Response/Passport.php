<?php

namespace Dadata\Response;

class Passport extends Base
{
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
    /**
     * @var integer Код качества паспорта
     *              0	Действующий паспорт
     *              1	Неправильный формат серии или номера
     *              2	Исходное значение пустое
     *              10	Недействительный паспорт
     */
    public $qc;
}
