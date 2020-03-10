<?php

namespace Gietos\Dadata\Model\Response;

use Gietos\Dadata\Model\AbstractModel;

class Address extends AbstractModel
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
     * Адрес распознан уверенно, ручная проверка не требуется
     */
    const QC_OK = 0;

    /**
     * Телефон распознан с допущениями или не распознан, требется ручная проверка
     */
    const QC_INVALID = 1;

    /**
     * Адрес пустой или заведомо «мусорный», ручная проверка не требуется
     */
    const QC_EMPTY = 2;

    /**
     * @var string Индекс
     */
    protected $postalCode;

    /**
     * @var string Страна
     */
    protected $country;

    /**
     * @var string Код ФИАС региона
     */
    protected $regionFiasId;

    /**
     * @var string Код КЛАДР региона
     */
    protected $regionKladrId;

    /**
     * @var string Регион с типом
     */
    protected $regionWithType;

    /**
     * @var string Тип региона (сокращенный)
     */
    protected $regionType;

    /**
     * @var string Тип региона
     */
    protected $regionTypeFull;

    /**
     * @var string Регион
     */
    protected $region;

    /**
     * @var string Код ФИАС района в регионе
     */
    protected $areaFiasId;

    /**
     * @var string Код КЛАДР района в регионе
     */
    protected $areaKladrId;

    /**
     * @var string Район в регионе с типом
     */
    protected $areaWithType;

    /**
     * @var string Тип района в регионе (сокращенный)
     */
    protected $areaType;

    /**
     * @var string Тип района в регионе
     */
    protected $areaTypeFull;

    /**
     * @var string Район в регионе
     */
    protected $area;

    /**
     * @var string Код ФИАС города
     */
    protected $cityFiasId;

    /**
     * @var string Код КЛАДР города
     */
    protected $cityKladrId;

    /**
     * @var string Город с типом
     */
    protected $cityWithType;

    /**
     * @var string Тип города (сокращенный)
     */
    protected $cityType;

    /**
     * @var string Тип города
     */
    protected $cityTypeFull;

    /**
     * @var string Город
     */
    protected $city;

    /**
     * @var string Административный округ (только для Москвы)
     */
    protected $cityArea;

    /**
     * @var string Код ФИАС района города (не заполняется)
     */
    protected $cityDistrictFiasId;

    /**
     * @var string Код КЛАДР района города (не заполняется)
     */
    protected $cityDistrictKladrId;

    /**
     * @var string Район города с типом
     */
    protected $cityDistrictWithType;

    /**
     * @var string Тип района города (сокращенный)
     */
    protected $cityDistrictType;

    /**
     * @var string Тип района города
     */
    protected $cityDistrictTypeFull;

    /**
     * @var string Район города
     */
    protected $cityDistrict;

    /**
     * @var string Код ФИАС нас. пункта
     */
    protected $settlementFiasId;

    /**
     * @var string Код КЛАДР нас. пункта
     */
    protected $settlementKladrId;

    /**
     * @var string Населенный пункт с типом
     */
    protected $settlementWithType;

    /**
     * @var string Тип населенного пункта (сокращенный)
     */
    protected $settlementType;

    /**
     * @var string Тип населенного пункта
     */
    protected $settlementTypeFull;

    /**
     * @var string Населенный пункт
     */
    protected $settlement;

    /**
     * @var string Код ФИАС улицы
     */
    protected $streetFiasId;

    /**
     * @var string Код КЛАДР улицы
     */
    protected $streetKladrId;

    /**
     * @var string Улица с типом
     */
    protected $streetWithType;

    /**
     * @var string Тип улицы (сокращенный)
     */
    protected $streetType;

    /**
     * @var string Тип улицы
     */
    protected $streetTypeFull;

    /**
     * @var string Улица
     */
    protected $street;

    /**
     * @var string Код ФИАС дома
     */
    protected $houseFiasId;

    /**
     * @var string Код КЛАДР дома
     */
    protected $houseKladrId;

    /**
     * @var string Тип дома (сокращенный)
     */
    protected $houseType;

    /**
     * @var string Тип дома
     */
    protected $houseTypeFull;

    /**
     * @var string Дом
     */
    protected $house;

    /**
     * @var string Тип корпуса/строения (сокращенный)
     */
    protected $blockType;

    /**
     * @var string Тип корпуса/строения
     */
    protected $blockTypeFull;

    /**
     * @var string Корпус/строение
     */
    protected $block;

    /**
     * @var string Тип квартиры (сокращенный)
     */
    protected $flatType;

    /**
     * @var string Тип квартиры
     */
    protected $flatTypeFull;

    /**
     * @var string Квартира
     */
    protected $flat;

    /**
     * @var string Абонентский ящик
     */
    protected $postalBox;

    /**
     * @var string Код ФИАС:
     *                  HOUSE.HOUSEGUID, если дом найден в ФИАС по точному совпадению;
     *                  HOUSEINT.INTGUID, если дом найден в ФИАС как часть интервала;
     *                  ADDROBJ.AOGUID в противном случае.
     */
    protected $fiasId;

    /**
     * @var integer Уровень детализации, до которого адрес найден в ФИАС (see FIAS_* constants)
     */
    protected $fiasLevel;

    /**
     * @var string Код КЛАДР
     */
    protected $kladrId;

    /**
     * @var integer Является ли город центром (see CAPITAL_MARKER_* constants):
     */
    protected $capitalMarker;

    /**
     * @var string Код ОКАТО
     */
    protected $okato;

    /**
     * @var string Код ОКТМО
     */
    protected $oktmo;

    /**
     * @var string Код ИФНС для физических лиц
     */
    protected $taxOffice;

    /**
     * @var float Координаты: широта
     */
    protected $geoLat;

    /**
     * @var float Координаты: долгота
     */
    protected $geoLon;

    /**
     * @var integer Код точности координат (see QC_GEO_* constants)
     */
    protected $qcGeo;

    /**
     * @var string ISO-код страны (двухсимвольный)
     */
    public $country_iso_code;
    /**
     * @var string ISO-код региона
     */
    public $region_iso_code;

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country)
    {
        $this->country = $country;
    }

    public function getRegionFiasId(): ?string
    {
        return $this->regionFiasId;
    }

    public function setRegionFiasId(?string $regionFiasId)
    {
        $this->regionFiasId = $regionFiasId;
    }

    public function getRegionKladrId(): ?string
    {
        return $this->regionKladrId;
    }

    public function setRegionKladrId(?string $regionKladrId)
    {
        $this->regionKladrId = $regionKladrId;
    }

    public function getRegionWithType(): ?string
    {
        return $this->regionWithType;
    }

    public function setRegionWithType(?string $regionWithType)
    {
        $this->regionWithType = $regionWithType;
    }

    public function getRegionType(): ?string
    {
        return $this->regionType;
    }

    public function setRegionType(?string $regionType)
    {
        $this->regionType = $regionType;
    }

    public function getRegionTypeFull(): ?string
    {
        return $this->regionTypeFull;
    }

    public function setRegionTypeFull(?string $regionTypeFull)
    {
        $this->regionTypeFull = $regionTypeFull;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region)
    {
        $this->region = $region;
    }

    public function getAreaFiasId(): ?string
    {
        return $this->areaFiasId;
    }

    public function setAreaFiasId(?string $areaFiasId)
    {
        $this->areaFiasId = $areaFiasId;
    }

    public function getAreaKladrId(): ?string
    {
        return $this->areaKladrId;
    }

    public function setAreaKladrId(?string $areaKladrId)
    {
        $this->areaKladrId = $areaKladrId;
    }

    public function getAreaWithType(): ?string
    {
        return $this->areaWithType;
    }

    public function setAreaWithType(?string $areaWithType)
    {
        $this->areaWithType = $areaWithType;
    }

    public function getAreaType(): ?string
    {
        return $this->areaType;
    }

    public function setAreaType(?string $areaType)
    {
        $this->areaType = $areaType;
    }

    public function getAreaTypeFull(): ?string
    {
        return $this->areaTypeFull;
    }

    public function setAreaTypeFull(?string $areaTypeFull)
    {
        $this->areaTypeFull = $areaTypeFull;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area)
    {
        $this->area = $area;
    }

    public function getCityFiasId(): ?string
    {
        return $this->cityFiasId;
    }

    public function setCityFiasId(?string $cityFiasId)
    {
        $this->cityFiasId = $cityFiasId;
    }

    public function getCityKladrId(): ?string
    {
        return $this->cityKladrId;
    }

    public function setCityKladrId(?string $cityKladrId)
    {
        $this->cityKladrId = $cityKladrId;
    }

    public function getCityWithType(): ?string
    {
        return $this->cityWithType;
    }

    public function setCityWithType(?string $cityWithType)
    {
        $this->cityWithType = $cityWithType;
    }

    public function getCityType(): ?string
    {
        return $this->cityType;
    }

    public function setCityType(?string $cityType)
    {
        $this->cityType = $cityType;
    }

    public function getCityTypeFull(): ?string
    {
        return $this->cityTypeFull;
    }

    public function setCityTypeFull(?string $cityTypeFull)
    {
        $this->cityTypeFull = $cityTypeFull;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city)
    {
        $this->city = $city;
    }

    public function getCityArea(): ?string
    {
        return $this->cityArea;
    }

    public function setCityArea(?string $cityArea)
    {
        $this->cityArea = $cityArea;
    }

    public function getCityDistrictFiasId(): ?string
    {
        return $this->cityDistrictFiasId;
    }

    public function setCityDistrictFiasId(?string $cityDistrictFiasId)
    {
        $this->cityDistrictFiasId = $cityDistrictFiasId;
    }

    public function getCityDistrictKladrId(): ?string
    {
        return $this->cityDistrictKladrId;
    }

    public function setCityDistrictKladrId(?string $cityDistrictKladrId)
    {
        $this->cityDistrictKladrId = $cityDistrictKladrId;
    }

    public function getCityDistrictWithType(): ?string
    {
        return $this->cityDistrictWithType;
    }

    public function setCityDistrictWithType(?string $cityDistrictWithType)
    {
        $this->cityDistrictWithType = $cityDistrictWithType;
    }

    public function getCityDistrictType(): ?string
    {
        return $this->cityDistrictType;
    }

    public function setCityDistrictType(?string $cityDistrictType)
    {
        $this->cityDistrictType = $cityDistrictType;
    }

    public function getCityDistrictTypeFull(): ?string
    {
        return $this->cityDistrictTypeFull;
    }

    public function setCityDistrictTypeFull(?string $cityDistrictTypeFull)
    {
        $this->cityDistrictTypeFull = $cityDistrictTypeFull;
    }

    public function getCityDistrict(): ?string
    {
        return $this->cityDistrict;
    }

    public function setCityDistrict(?string $cityDistrict)
    {
        $this->cityDistrict = $cityDistrict;
    }

    public function getSettlementFiasId(): ?string
    {
        return $this->settlementFiasId;
    }

    public function setSettlementFiasId(?string $settlementFiasId)
    {
        $this->settlementFiasId = $settlementFiasId;
    }

    public function getSettlementKladrId(): ?string
    {
        return $this->settlementKladrId;
    }

    public function setSettlementKladrId(?string $settlementKladrId)
    {
        $this->settlementKladrId = $settlementKladrId;
    }

    public function getSettlementWithType(): ?string
    {
        return $this->settlementWithType;
    }

    public function setSettlementWithType(?string $settlementWithType)
    {
        $this->settlementWithType = $settlementWithType;
    }

    public function getSettlementType(): ?string
    {
        return $this->settlementType;
    }

    public function setSettlementType(?string $settlementType)
    {
        $this->settlementType = $settlementType;
    }

    public function getSettlementTypeFull(): ?string
    {
        return $this->settlementTypeFull;
    }

    public function setSettlementTypeFull(?string $settlementTypeFull)
    {
        $this->settlementTypeFull = $settlementTypeFull;
    }

    public function getSettlement(): ?string
    {
        return $this->settlement;
    }

    public function setSettlement(?string $settlement)
    {
        $this->settlement = $settlement;
    }

    public function getStreetFiasId(): ?string
    {
        return $this->streetFiasId;
    }

    public function setStreetFiasId(?string $streetFiasId)
    {
        $this->streetFiasId = $streetFiasId;
    }

    public function getStreetKladrId(): ?string
    {
        return $this->streetKladrId;
    }

    public function setStreetKladrId(?string $streetKladrId)
    {
        $this->streetKladrId = $streetKladrId;
    }

    public function getStreetWithType(): ?string
    {
        return $this->streetWithType;
    }

    public function setStreetWithType(?string $streetWithType)
    {
        $this->streetWithType = $streetWithType;
    }

    public function getStreetType(): ?string
    {
        return $this->streetType;
    }

    public function setStreetType(?string $streetType)
    {
        $this->streetType = $streetType;
    }

    public function getStreetTypeFull(): ?string
    {
        return $this->streetTypeFull;
    }

    public function setStreetTypeFull(?string $streetTypeFull)
    {
        $this->streetTypeFull = $streetTypeFull;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street)
    {
        $this->street = $street;
    }

    public function getHouseFiasId(): ?string
    {
        return $this->houseFiasId;
    }

    public function setHouseFiasId(?string $houseFiasId)
    {
        $this->houseFiasId = $houseFiasId;
    }

    public function getHouseKladrId(): ?string
    {
        return $this->houseKladrId;
    }

    public function setHouseKladrId(?string $houseKladrId)
    {
        $this->houseKladrId = $houseKladrId;
    }

    public function getHouseType(): ?string
    {
        return $this->houseType;
    }

    public function setHouseType(?string $houseType)
    {
        $this->houseType = $houseType;
    }

    public function getHouseTypeFull(): ?string
    {
        return $this->houseTypeFull;
    }

    public function setHouseTypeFull(?string $houseTypeFull)
    {
        $this->houseTypeFull = $houseTypeFull;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function setHouse(?string $house)
    {
        $this->house = $house;
    }

    public function getBlockType(): ?string
    {
        return $this->blockType;
    }

    public function setBlockType(?string $blockType)
    {
        $this->blockType = $blockType;
    }

    public function getBlockTypeFull(): ?string
    {
        return $this->blockTypeFull;
    }

    public function setBlockTypeFull(?string $blockTypeFull)
    {
        $this->blockTypeFull = $blockTypeFull;
    }

    public function getBlock(): ?string
    {
        return $this->block;
    }

    public function setBlock(?string $block)
    {
        $this->block = $block;
    }

    public function getFlatType(): ?string
    {
        return $this->flatType;
    }

    public function setFlatType(?string $flatType)
    {
        $this->flatType = $flatType;
    }

    public function getFlatTypeFull(): ?string
    {
        return $this->flatTypeFull;
    }

    public function setFlatTypeFull(?string $flatTypeFull)
    {
        $this->flatTypeFull = $flatTypeFull;
    }

    public function getFlat(): ?string
    {
        return $this->flat;
    }

    public function setFlat(?string $flat)
    {
        $this->flat = $flat;
    }

    public function getPostalBox(): ?string
    {
        return $this->postalBox;
    }

    public function setPostalBox(?string $postalBox)
    {
        $this->postalBox = $postalBox;
    }

    public function getFiasId(): ?string
    {
        return $this->fiasId;
    }

    public function setFiasId(?string $fiasId)
    {
        $this->fiasId = $fiasId;
    }

    public function getFiasLevel(): ?int
    {
        return $this->fiasLevel;
    }

    public function setFiasLevel(?int $fiasLevel)
    {
        $this->fiasLevel = $fiasLevel;
    }

    public function getKladrId(): ?string
    {
        return $this->kladrId;
    }

    public function setKladrId(?string $kladrId)
    {
        $this->kladrId = $kladrId;
    }

    public function getCapitalMarker(): ?int
    {
        return $this->capitalMarker;
    }

    public function setCapitalMarker(?int $capitalMarker)
    {
        $this->capitalMarker = $capitalMarker;
    }

    public function getOkato(): ?string
    {
        return $this->okato;
    }

    public function setOkato(?string $okato)
    {
        $this->okato = $okato;
    }

    public function getOktmo(): ?string
    {
        return $this->oktmo;
    }

    public function setOktmo(?string $oktmo)
    {
        $this->oktmo = $oktmo;
    }

    public function getTaxOffice(): ?string
    {
        return $this->taxOffice;
    }

    public function setTaxOffice(?string $taxOffice)
    {
        $this->taxOffice = $taxOffice;
    }

    public function getGeoLat(): ?float
    {
        return $this->geoLat;
    }

    public function setGeoLat(?float $geoLat)
    {
        $this->geoLat = $geoLat;
    }

    public function getGeoLon(): ?float
    {
        return $this->geoLon;
    }

    public function setGeoLon(?float $geoLon)
    {
        $this->geoLon = $geoLon;
    }

    public function getQcGeo(): ?int
    {
        return $this->qcGeo;
    }

    public function setQcGeo(?int $qcGeo)
    {
        $this->qcGeo = $qcGeo;
    }
}
