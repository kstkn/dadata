<?php

namespace Dadata\Response;

class Address extends AbstractResponse
{
    /**
     * внутри МКАД (Москва)
     */
    const BELTWAY_HIT_IN_MKAD = 'IN_MKAD';

    /**
     * за МКАД (Москва или Московская область)
     */
    const BELTWAY_HIT_OUT_MKAD = 'OUT_MKAD';

    /**
     * внутри КАД (Санкт-Петербург)
     */
    const BELTWAY_HIT_IN_KAD = 'IN_KAD';

    /**
     * за КАД (Санкт-Петербург или Ленинградская область)
     */
    const BELTWAY_HIT_OUT_KAD = 'OUT_KAD';

    /**
     * Страна
     */
    const FIAS_COUNTRY = 0;

    /**
     * Регион
     */
    const FIAS_REGION = 1;

    /**
     * Район
     */
    const FIAS_AREA = 3;

    /**
     * Город
     */
    const FIAS_CITY = 4;

    /**
     * Населенный пункт
     */
    const FIAS_SETTLEMENT = 6;

    /**
     * Улица
     */
    const FIAS_STREET = 7;

    /**
     * Дом
     */
    const FIAS_HOUSE = 8;

    /**
     * Иностранный или пустой
     */
    const FIAS_UNKNOWN = -1;

    /**
     * Центр района (Московская обл, Одинцовский р-н, г Одинцово)
     */
    const CAPITAL_MARKER_AREA_CENTER = 1;

    /**
     * Центр региона (Новосибирская обл, г Новосибирск)
     */
    const CAPITAL_MARKER_REGION_CENTER = 2;

    /**
     * Центр района и региона (Костромская обл, Костромской р-н, г Кострома)
     */
    const CAPITAL_MARKER_AREA_AND_REGION_CENTER = 3;

    /**
     * Ни то, ни другое (Московская обл, г Балашиха).
     */
    const CAPITAL_MARKER_NONE = 0;

    /**
     * Точные координаты
     */
    const QC_GEO_EXACT = 0;

    /**
     * Ближайший дом
     */
    const QC_GEO_CLOSEST_HOUSE = 1;

    /**
     * Улица
     */
    const QC_GEO_STREET = 2;

    /**
     * Населенный пункт
     */
    const QC_GEO_SETTLEMENT = 3;

    /**
     * Город
     */
    const QC_GEO_CITY = 4;

    /**
     * Координаты не определены
     */
    const QC_GEO_UNKNOWN = 5;

    /**
     * Пригоден для почтовой рассылки
     */
    const QC_COMPLETE_OK = 0;

    /**
     * Не пригоден, нет региона
     */
    const QC_COMPLETE_NO_REGION = 1;

    /**
     * Не пригоден, нет города
     */
    const QC_COMPLETE_NO_CITY = 2;

    /**
     * Не пригоден, нет улицы
     */
    const QC_COMPLETE_NO_STREET = 3;

    /**
     * Не пригоден, нет дома
     */
    const QC_COMPLETE_NO_HOUSE = 4;

    /**
     * Пригоден для юридических лиц или частных владений (нет квартиры)
     */
    const QC_COMPLETE_NO_FLAT = 5;

    /**
     * Не пригоден
     */
    const QC_COMPLETE_BAD = 6;

    /**
     * Иностранный адрес
     */
    const QC_COMPLETE_FOREIGN = 7;

    /**
     * До почтового отделения (абонентский ящик или адрес до востребования).
     *                   Подходит для писем, но не для курьерской доставки.
     */
    const QC_COMPLETE_POST_OFFICE = 8;

    /**
     * Пригоден, но низкая вероятность успешной доставки (дом не найден в ФИАС)
     */
    const QC_COMPLETE_LOW = 10;


    /**
     * Дом найден в ФИАС по точному совпадению
     */
    const QC_HOUSE_HIGH = 2;

    /**
     * В ФИАС найден похожий дом; различие в литере, корпусе или строении
     */
    const QC_HOUSE_MEDIUM_SIMILAR = 3;

    /**
     * Дом найден в ФИАС по диапазону
     */
    const QC_HOUSE_MEDIUM_RANGE = 4;

    /**
     * Дом не найден в ФИАС
     */
    const QC_HOUSE_LOW = 10;

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
     * @var integer Уровень детализации, до которого адрес найден в ФИАС (see constants FIAS_*)
     */
    public $fias_level;

    /**
     * @var string|null Код КЛАДР
     */
    public $kladr_id;

    /**
     * @var integer Является ли город центром (see constants CAPITAL_MARKER_*):
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
     * @var string|null Внутри кольцевой? BELTWAY_HIT_* constants
     */
    public $beltway_hit;

    /**
     * @var int|null Расстояние от кольцевой в км.
     *               Заполнено, только если beltway_hit = OUT_MKAD или OUT_KAD, иначе пустое.
     */
    public $beltway_distance;

    /**
     * @var integer Код точности координат (see constants QC_GEO_*)
     */
    public $qc_geo;

    /**
     * @var integer Код полноты (see QC_COMPLETE_* constants)
     */
    public $qc_complete;

    /**
     * @var integer Признак наличия дома в ФИАС - уточняет вероятность успешной доставки письма
     *              (see QC_HOUSE_* constants)
     */
    public $qc_house;

    /**
     * @var string Нераспознанная часть адреса. Для адреса
     */
    public $unparsed_parts;

    public function __toString()
    {
        return (string) $this->result;
    }
}
