<?php

namespace Dadata\Response;

class Address extends Base
{
    /**
     * @var string Исходный адрес одной строкой
     */
    public $source;
    /**
     * @var string|null Стандартизованный адрес одной строкой
     */
    public $result;
    /**
     * @var string|null Индекс
     */
    public $postal_code;
    /**
     * @var string|null Страна
     */
    public $country;
    /**
     * @var string|null Тип региона (сокращенный)
     */
    public $region_type;
    /**
     * @var string|null Тип региона
     */
    public $region_type_full;
    /**
     * @var string|null Регион
     */
    public $region;
    /**
     * @var string|null Тип района в регионе (сокращенный)
     */
    public $area_type;
    /**
     * @var string|null Тип района в регионе
     */
    public $area_type_full;
    /**
     * @var string|null Район в регионе
     */
    public $area;
    /**
     * @var string|null Тип города (сокращенный)
     */
    public $city_type;
    /**
     * @var string|null Тип города
     */
    public $city_type_full;
    /**
     * @var string|null Город
     */
    public $city;
    /**
     * @var string|null Тип населенного пункта (сокращенный)
     */
    public $settlement_type;
    /**
     * @var string|null Тип населенного пункта
     */
    public $settlement_type_full;
    /**
     * @var string|null Населенный пункт
     */
    public $settlement;
    /**
     * @var string|null Район города
     */
    public $city_district;
    /**
     * @var string|null Тип улицы (сокращенный)
     */
    public $street_type;
    /**
     * @var string|null Тип улицы
     */
    public $street_type_full;
    /**
     * @var string|null Улица
     */
    public $street;
    /**
     * @var string|null Тип дома (сокращенный)
     */
    public $house_type;
    /**
     * @var string|null Тип дома
     */
    public $house_type_full;
    /**
     * @var string|null Дом
     */
    public $house;
    /**
     * @var string|null Тип корпуса/строения (сокращенный)
     */
    public $block_type;
    /**
     * @var string|null Тип корпуса/строения
     */
    public $block_type_full;
    /**
     * @var string|null Корпус/строение
     */
    public $block;
    /**
     * @var string|null Тип квартиры (сокращенный)
     */
    public $flat_type;
    /**
     * @var string|null Тип квартиры
     */
    public $flat_type_full;
    /**
     * @var string|null Квартира
     */
    public $flat;
    /**
     * @var float|null Площадь квартиры
     */
    public $flat_area;
    /**
     * @var string|null Рыночная стоимость м²
     */
    public $square_meter_price;
    /**
     * @var string|null Рыночная стоимость квартиры
     */
    public $flat_price;
    /**
     * @var string|null Абонентский ящик
     */
    public $postal_box;
    /**
     * @var string|null Код ФИАС:
     *                  HOUSE.HOUSEGUID, если дом найден в ФИАС по точному совпадению;
     *                  HOUSEINT.INTGUID, если дом найден в ФИАС как часть интервала;
     *                  ADDROBJ.AOGUID в противном случае.
     */
    public $fias_id;
    /**
     * @var integer Уровень детализации, до которого адрес найден в ФИАС:
     *              0 — страна;
     *              1 — регион;
     *              3 — район;
     *              4 — город;
     *              6 — населенный пункт;
     *              7 — улица;
     *              8 — дом;
     *              -1 — иностранный или пустой.
     */
    public $fias_level;
    /**
     * @var string|null Код КЛАДР
     */
    public $kladr_id;
    /**
     * @var integer Является ли город центром:
     *             1 — центр района (Московская обл, Одинцовский р-н, г Одинцово)
     *             2 — центр региона (Новосибирская обл, г Новосибирск);
     *             3 — центр района и региона (Костромская обл, Костромской р-н, г Кострома);
     *             0 — ни то, ни другое (Московская обл, г Балашиха).
     */
    public $capital_marker;
    /**
     * @var string|null Код ОКАТО
     */
    public $okato;
    /**
     * @var string|null Код ОКТМО
     */
    public $oktmo;
    /**
     * @var string|null Код ИФНС для физических лиц
     */
    public $tax_office;
    /**
     * @var string|null Код ИФНС для организаций (не заполняется)
     */
    public $tax_office_legal;
    /**
     * @var string|null Часовой пояс
     */
    public $timezone;
    /**
     * @var float|null Координаты: широта
     */
    public $geo_lat;
    /**
     * @var float|null Координаты: долгота
     */
    public $geo_lon;
    /**
     * @var integer Код точности координат
     *              0    Точные координаты
     *              1    Ближайший дом
     *              2    Улица
     *              3    Населенный пункт
     *              4    Город
     *              5    Координаты не определены
     */
    public $qc_geo;
    /**
     * @var integer Код полноты
     *              0    Пригоден для почтовой рассылки
     *              1    Не пригоден, нет региона
     *              2    Не пригоден, нет города
     *              3    Не пригоден, нет улицы
     *              4    Не пригоден, нет дома
     *              5    Пригоден для юридических лиц или частных владений (нет квартиры)
     *              6    Не пригоден
     *              7    Иностранный адрес
     *              8    До почтового отделения (абонентский ящик или адрес до востребования).
     *                   Подходит для писем, но не для курьерской доставки.
     *              10    Пригоден, но низкая вероятность успешной доставки (дом не найден в ФИАС)
     */
    public $qc_complete;
    /**
     * @var integer Код проверки дома
     *              2    Дом найден в ФИАС по точному совпадению
     *              3    В ФИАС найден похожий дом; различие в литере, корпусе или строении
     *              4    Дом найден в ФИАС по диапазону
     *              10    Дом не найден в ФИАС
     */
    public $qc_house;
    /**
     * @var string Нераспознанная часть адреса. Для адреса
     */
    public $unparsed_parts;

    public function __toString()
    {
        return empty($this->result) ? '' : $this->result;
    }
}
